<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateEditorController extends Controller
{
    /**
     * عرض صفحة محرر القوالب
     */
    public function index()
    {
        $templates = $this->getAvailableTemplates();
        return view('admin.templates.editor', compact('templates'));
    }

    /**
     * تحميل قالب محدد
     */
    public function load($type)
    {
        $templatePath = $this->getTemplatePath($type);
        
        if (!Storage::disk('local')->exists($templatePath)) {
            return response()->json([
                'success' => false,
                'message' => 'القالب غير موجود'
            ], 404);
        }

        $content = Storage::disk('local')->get($templatePath);
        
        return response()->json([
            'success' => true,
            'content' => $content,
            'type' => $type
        ]);
    }

    /**
     * حفظ القالب المعدل
     */
    public function save(Request $request)
    {
        $request->validate([
            'type' => 'required|in:negative-certificate,property-card',
            'content' => 'required|string'
        ]);

        $type = $request->type;
        $content = $request->content;
        
        $templatePath = $this->getTemplatePath($type);
        
        // إنشاء نسخة احتياطية
        $this->createBackup($type);
        
        // حفظ القالب الجديد
        Storage::disk('local')->put($templatePath, $content);
        
        return response()->json([
            'success' => true,
            'message' => 'تم حفظ القالب بنجاح'
        ]);
    }

    /**
     * حفظ إعدادات القالب (JSON)
     */
    public function saveSettings(Request $request)
    {
        $request->validate([
            'type' => 'required|in:negative-certificate,property-card',
            'settings' => 'required|string'
        ]);

        $type = $request->type;
        $settings = $request->settings;
        
        $settingsPath = "templates/settings/{$type}.json";
        
        Storage::disk('local')->put($settingsPath, $settings);
        
        return response()->json([
            'success' => true,
            'message' => 'تم حفظ الإعدادات بنجاح'
        ]);
    }

    /**
     * تحميل إعدادات القالب
     */
    public function loadSettings($type)
    {
        $settingsPath = "templates/settings/{$type}.json";
        
        if (!Storage::disk('local')->exists($settingsPath)) {
            return response()->json([
                'success' => true,
                'settings' => null
            ]);
        }

        $settings = Storage::disk('local')->get($settingsPath);
        
        return response()->json([
            'success' => true,
            'settings' => json_decode($settings, true)
        ]);
    }

    /**
     * استعادة القالب الافتراضي
     */
    public function restore($type)
    {
        $defaultPath = $this->getDefaultTemplatePath($type);
        $templatePath = $this->getTemplatePath($type);
        
        if (!Storage::disk('local')->exists($defaultPath)) {
            return response()->json([
                'success' => false,
                'message' => 'القالب الافتراضي غير موجود'
            ], 404);
        }

        $content = Storage::disk('local')->get($defaultPath);
        Storage::disk('local')->put($templatePath, $content);
        
        return response()->json([
            'success' => true,
            'message' => 'تم استعادة القالب الافتراضي'
        ]);
    }

    /**
     * الحصول على القوالب المتاحة
     */
    private function getAvailableTemplates()
    {
        return [
            [
                'id' => 'negative-certificate',
                'name' => 'شهادة سلبية',
                'icon' => '📄',
                'description' => 'قالب طباعة الشهادة السلبية'
            ],
            [
                'id' => 'property-card',
                'name' => 'بطاقة عقارية',
                'icon' => '🏠',
                'description' => 'قالب طباعة البطاقة العقارية'
            ]
        ];
    }

    /**
     * الحصول على مسار القالب
     */
    private function getTemplatePath($type)
    {
        return "templates/{$type}.html";
    }

    /**
     * الحصول على مسار القالب الافتراضي
     */
    private function getDefaultTemplatePath($type)
    {
        return "templates/defaults/{$type}.html";
    }

    /**
     * إنشاء نسخة احتياطية
     */
    private function createBackup($type)
    {
        $templatePath = $this->getTemplatePath($type);
        
        if (!Storage::disk('local')->exists($templatePath)) {
            return;
        }

        $content = Storage::disk('local')->get($templatePath);
        $backupPath = "templates/backups/{$type}_" . date('Y-m-d_H-i-s') . ".html";
        
        Storage::disk('local')->put($backupPath, $content);
        
        // حذف النسخ الاحتياطية القديمة (الاحتفاظ بآخر 10)
        $this->cleanOldBackups($type);
    }

    /**
     * حذف النسخ الاحتياطية القديمة
     */
    private function cleanOldBackups($type)
    {
        $backups = Storage::disk('local')->files('templates/backups');
        $typeBackups = array_filter($backups, function($file) use ($type) {
            return strpos($file, "backups/{$type}_") !== false;
        });

        if (count($typeBackups) > 10) {
            usort($typeBackups, function($a, $b) {
                return Storage::disk('local')->lastModified($a) <=> Storage::disk('local')->lastModified($b);
            });

            $toDelete = array_slice($typeBackups, 0, count($typeBackups) - 10);
            foreach ($toDelete as $file) {
                Storage::disk('local')->delete($file);
            }
        }
    }
}