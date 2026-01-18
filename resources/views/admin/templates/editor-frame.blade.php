<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>محرر القوالب - {{ $templateName }}</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Cairo:wght@600;700&display=swap" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>

  <link rel="stylesheet" href="{{ asset('css/template-editor.css') }}">
</head>

<body>
  <div class="toolbar">
    <div class="group">
      <button id="btnEdit" class="primary">تفعيل وضع التعديل</button>
      <button id="btnSave" class="ok" disabled>💾 حفظ التغييرات</button>
      <button id="btnReset" class="danger" disabled>↺ إرجاع الافتراضي</button>
    </div>

    <div class="group">
      <button id="btnAddPage" disabled>➕ إضافة صفحة</button>
      <button id="btnRemovePage" disabled>➖ حذف الصفحة الحالية</button>
      <span id="pageIndicator" class="page-indicator">صفحة 1 من 1</span>
    </div>

    <div class="group">
      <button id="btnExportJson" disabled>📥 تصدير JSON</button>
      <label style="display:inline-flex; gap:8px; align-items:center;">
        <input id="fileImport" type="file" accept="application/json" style="display:none;">
        <button id="btnImportJson" disabled type="button">📤 استيراد JSON</button>
      </label>
      <button id="btnPreview" disabled>👁️ معاينة الطباعة</button>
    </div>

    <div class="hint">
      في وضع التعديل: انقر لتحديد عنصر، اسحب لتحريكه، اسحب الحواف لتغيير الحجم.
      النصوص المظللة قابلة للتعديل المباشر.
    </div>
  </div>

  <div class="workspace" id="workspace">
    <!-- الصفحات ستضاف هنا ديناميكياً -->
  </div>

  <script src="{{ asset('js/template-editor.js') }}"></script>
  <script>
    // تمرير معلومات القالب
    window.TEMPLATE_TYPE = '{{ $templateType }}';
    window.TEMPLATE_NAME = '{{ $templateName }}';
    window.CSRF_TOKEN = '{{ csrf_token() }}';
  </script>
</body>
</html>