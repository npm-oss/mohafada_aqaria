<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NegativeCertificate;

class NegativeCertificateAdminController extends Controller
{
    // 1️⃣ قائمة جميع الطلبات
    public function index()
    {
        $certificates = NegativeCertificate::orderBy('created_at', 'desc')->get();
        return view('admin.certificates.index', compact('certificates'));
    }

    // 2️⃣ عرض طلب واحد
    public function show($id)
    {
        $certificate = NegativeCertificate::findOrFail($id);
        return view('admin.certificates.show', compact('certificate'));
    }

    // 3️⃣ صفحة معالجة الطلب
    public function process($id)
    {
        $certificate = NegativeCertificate::findOrFail($id);

        // تغيير الحالة مباشرة عند الدخول لصفحة المعالجة
        if ($certificate->status === 'pending') {
            $certificate->status = 'processing';
            $certificate->save();
        }

        return view('admin.certificates.process', compact('certificate'));
    }

    // 3.1️⃣ تحديث بيانات الحقول أثناء المعالجة
    public function updateFields(Request $request, $id)
    {
        $certificate = NegativeCertificate::findOrFail($id);

        $request->validate([
            'owner_lastname'    => 'required|string|max:255',
            'owner_firstname'   => 'required|string|max:255',
            'owner_father'      => 'nullable|string|max:255',
            'gender'            => 'required|string|in:ذكر,أنثى',
            'owner_birthdate'   => 'nullable|date',
            'owner_birthplace'  => 'nullable|string|max:255',
            'state'             => 'nullable|string|max:255',
            'municipality'      => 'nullable|string|max:255',
        ]);

        $certificate->update([
            'owner_lastname'    => $request->owner_lastname,
            'owner_firstname'   => $request->owner_firstname,
            'owner_father'      => $request->owner_father,
            'gender'            => $request->gender,
            'owner_birthdate'   => $request->owner_birthdate,
            'owner_birthplace'  => $request->owner_birthplace,
            'state'             => $request->state,
            'municipality'      => $request->municipality,
        ]);

        return back()->with('success', 'تم تحديث بيانات المواطن بنجاح');
    }

    // 4️⃣ قبول الطلب
    public function approve($id)
    {
        $certificate = NegativeCertificate::findOrFail($id);
        $certificate->status = 'approved';
        $certificate->save();

        return back()->with('success', 'تم قبول الطلب');
    }

    // 5️⃣ رفض الطلب
    public function reject($id)
    {
        $certificate = NegativeCertificate::findOrFail($id);
        $certificate->status = 'rejected';
        $certificate->save();

        return back()->with('error', 'تم رفض الطلب');
    }

    // 6️⃣ استخراج الشهادة
    public function extract($id)
    {
        $certificate = NegativeCertificate::findOrFail($id);
        $certificate->status = 'extracted';
        $certificate->save();

        // يمكن توليد PDF هنا إذا تحبي
        // return PDF::loadView('admin.certificates.pdf', compact('certificate'))->stream();

        return back()->with('success', 'تم استخراج الشهادة');
    }

    // 7️⃣ إنشاء شهادة جديدة
    public function create()
    {
        return view('admin.certificates.create');
    }

    // 8️⃣ تخزين شهادة جديدة
    public function store(Request $request)
    {
        $request->validate([
            'owner_lastname' => 'required',
            'owner_firstname' => 'required',
            'applicant_lastname' => 'required',
            'applicant_firstname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        NegativeCertificate::create($request->all());

        return redirect()->route('admin.certificates.index')
                         ->with('success', 'تمت إضافة الشهادة بنجاح');
    }

    // 9️⃣ أرشفة الطلب
    public function archive($id)
    {
        $certificate = NegativeCertificate::findOrFail($id);
        $certificate->status = 'archived';
        $certificate->save();

        return back()->with('success', 'تم أرشفة الطلب');
    }

    // 🔟 حذف الطلب
    public function destroy($id)
    {
        $certificate = NegativeCertificate::findOrFail($id);
        $certificate->delete();

        return redirect()->route('admin.certificates.index')
                         ->with('success', 'تم حذف الطلب');
    }
}
