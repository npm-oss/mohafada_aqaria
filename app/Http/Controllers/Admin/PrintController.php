<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentsRequest;
use App\Models\NegativeCertificate;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    /**
     * طباعة شهادة سلبية
     */
    public function printNegativeCertificate($id)
    {
        $certificate = NegativeCertificate::findOrFail($id);
        
        // التحقق من أن الشهادة معتمدة
        if ($certificate->status !== 'approved') {
            return redirect()->back()->with('error', 'لا يمكن طباعة شهادة غير معتمدة');
        }

        $html = view('admin.print.negative-certificate', compact('certificate'))->render();
        
        return $this->generatePDF($html, "شهادة_سلبية_{$certificate->id}.pdf");
    }

    /**
     * طباعة بطاقة عقارية
     */
    public function printPropertyCard($id)
    {
        $document = DocumentsRequest::findOrFail($id);
        
        // التحقق من أن الطلب معتمد
        if ($document->status !== 'approved') {
            return redirect()->back()->with('error', 'لا يمكن طباعة بطاقة غير معتمدة');
        }

        $html = view('admin.print.property-card', compact('document'))->render();
        
        return $this->generatePDF($html, "بطاقة_عقارية_{$document->id}.pdf");
    }

    /**
     * إنشاء ملف PDF
     */
    private function generatePDF($html, $filename)
    {
        // إرجاع HTML مباشرة مع إعدادات الطباعة
        return response($html)
            ->header('Content-Type', 'text/html; charset=utf-8')
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}