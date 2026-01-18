@extends('layouts.admin-simple')

@section('title', 'محرر القوالب')

@section('content')
<style>
    .templates-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .page-header h1 {
        margin: 0 0 10px 0;
        font-size: 32px;
        font-weight: 700;
    }

    .page-header p {
        margin: 0;
        opacity: 0.9;
        font-size: 16px;
    }

    .templates-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .template-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid transparent;
    }

    .template-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        border-color: #667eea;
    }

    .template-icon {
        font-size: 48px;
        margin-bottom: 15px;
        display: block;
    }

    .template-name {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 8px;
        color: #333;
    }

    .template-description {
        color: #666;
        font-size: 14px;
        line-height: 1.5;
    }

    .editor-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.8);
        z-index: 10000;
        overflow: auto;
    }

    .editor-modal.active {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .editor-content {
        background: white;
        border-radius: 15px;
        width: 100%;
        max-width: 1600px;
        max-height: 95vh;
        display: flex;
        flex-direction: column;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }

    .editor-header {
        padding: 20px 30px;
        border-bottom: 2px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8f9fa;
        border-radius: 15px 15px 0 0;
    }

    .editor-header h2 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }

    .editor-close {
        background: #dc3545;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: background 0.3s;
    }

    .editor-close:hover {
        background: #c82333;
    }

    .editor-body {
        flex: 1;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    #editorFrame {
        width: 100%;
        flex: 1;
        border: none;
        background: white;
    }

    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255,255,255,0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #667eea;
        z-index: 1000;
    }

    .loading-overlay.hidden {
        display: none;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .spinner {
        display: inline-block;
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-left: 15px;
    }
</style>

<div class="templates-container">
    <div class="page-header">
        <h1>🎨 محرر القوالب</h1>
        <p>قم بتخصيص قوالب الطباعة للشهادات والبطاقات العقارية</p>
    </div>

    <div class="templates-grid">
        @foreach($templates as $template)
        <div class="template-card" onclick="openEditor('{{ $template['id'] }}')">
            <span class="template-icon">{{ $template['icon'] }}</span>
            <div class="template-name">{{ $template['name'] }}</div>
            <div class="template-description">{{ $template['description'] }}</div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal المحرر -->
<div class="editor-modal" id="editorModal">
    <div class="editor-content">
        <div class="editor-header">
            <h2 id="editorTitle">محرر القالب</h2>
            <button class="editor-close" onclick="closeEditor()">✕ إغلاق</button>
        </div>
        <div class="editor-body">
            <div class="loading-overlay" id="loadingOverlay">
                <span>جاري التحميل...</span>
                <div class="spinner"></div>
            </div>
            <iframe id="editorFrame" src="about:blank"></iframe>
        </div>
    </div>
</div>

<script>
    let currentTemplate = null;

    function openEditor(templateId) {
        currentTemplate = templateId;
        const modal = document.getElementById('editorModal');
        const frame = document.getElementById('editorFrame');
        const loading = document.getElementById('loadingOverlay');
        const title = document.getElementById('editorTitle');

        // تحديث العنوان
        const templateNames = {
            'negative-certificate': 'محرر قالب الشهادة السلبية',
            'property-card': 'محرر قالب البطاقة العقارية'
        };
        title.textContent = templateNames[templateId] || 'محرر القالب';

        // عرض المحرر
        modal.classList.add('active');
        loading.classList.remove('hidden');

        // تحميل المحرر
        frame.src = '/admin/templates/editor-frame/' + templateId;

        // إخفاء التحميل بعد تحميل الإطار
        frame.onload = function() {
            setTimeout(() => {
                loading.classList.add('hidden');
            }, 500);
        };
    }

    function closeEditor() {
        const modal = document.getElementById('editorModal');
        const frame = document.getElementById('editorFrame');
        
        modal.classList.remove('active');
        frame.src = 'about:blank';
        currentTemplate = null;
    }

    // إغلاق عند النقر خارج المحتوى
    document.getElementById('editorModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditor();
        }
    });

    // منع إغلاق عند الضغط على Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('editorModal').classList.contains('active')) {
            if (confirm('هل تريد إغلاق المحرر؟ تأكد من حفظ التغييرات أولاً.')) {
                closeEditor();
            }
        }
    });
</script>
@endsection