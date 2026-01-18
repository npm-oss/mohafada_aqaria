<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>محرر القوالب - {{ $templateName }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&family=Amiri:wght@400;700&family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Interact.js -->
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    <!-- HTML2Canvas & jsPDF -->
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
    <script src="/js/custom-modal.js"></script>
    
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --secondary: #64748b;
            --success: #059669;
            --danger: #dc2626;
            --warning: #d97706;
            --bg-dark: #1e293b;
            --bg-light: #f1f5f9;
            --surface: #ffffff;
            --border: #e2e8f0;
            --text-main: #334155;
            --text-light: #64748b;
            --page-width: 210mm;
            --page-height: 297mm;
        }

        * {
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Tajawal', system-ui, sans-serif;
            background: var(--bg-light);
            overflow: hidden; /* Prevent body scroll, layout handles it */
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Top Toolbar */
        .top-toolbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            z-index: 50;
        }

        .toolbar-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .toolbar-title {
            font-weight: 800;
            color: var(--primary);
            font-size: 18px;
            margin-left: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .toolbar-btn {
            padding: 8px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
            background: var(--surface);
            color: var(--text-main);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .toolbar-btn:hover:not(:disabled) {
            background: var(--bg-light);
            transform: translateY(-1px);
        }

        .toolbar-btn:active:not(:disabled) {
            transform: translateY(0);
        }

        .toolbar-btn.primary {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        .toolbar-btn.primary:hover:not(:disabled) { background: var(--primary-hover); }

        .toolbar-btn.success {
            background: var(--success);
            color: white;
            border-color: var(--success);
        }
        .toolbar-btn.success:hover:not(:disabled) { background: #047857; }

        .toolbar-btn.danger {
            background: var(--danger);
            color: white;
            border-color: var(--danger);
        }
        .toolbar-btn.danger:hover:not(:disabled) { background: #b91c1c; }

        .toolbar-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Workspace Layout */
        .editor-workspace {
            display: flex;
            flex: 1;
            overflow: hidden;
            position: relative;
        }

        /* Sidebar */
        .sidebar-tools {
            width: 280px;
            background: var(--surface);
            border-left: 1px solid var(--border);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            z-index: 40;
        }

        .sidebar-content {
            padding: 20px;
        }

        .tool-section {
            margin-bottom: 30px;
        }

        .tool-section h3 {
            margin: 0 0 15px 0;
            font-size: 14px;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .tool-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .tool-item {
            padding: 15px 10px;
            border: 1px solid var(--border);
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: var(--bg-light);
        }

        .tool-item:hover {
            border-color: var(--primary);
            background: #eef2ff; /* Light indigo */
            color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .tool-icon {
            font-size: 24px;
            margin-bottom: 8px;
            display: block;
        }

        .tool-name {
            font-size: 12px;
            font-weight: 600;
        }

        /* Properties Panel */
        .properties-panel {
            background: var(--surface);
            border-top: 1px solid var(--border);
            margin-top: auto; /* Push to bottom if needed, or structured differently */
            padding: 20px;
            display: none;
            border-bottom: 25px;
        }

        .properties-panel.active {
            display: block;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .property-group {
            margin-bottom: 15px;
        }

        .property-label {
            display: block;
            margin-bottom: 6px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-light);
        }

        .property-input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-family: inherit;
            font-size: 13px;
            color: var(--text-main);
            background: var(--bg-light);
            transition: border 0.2s;
        }

        .property-input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        .color-picker-group {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .color-picker {
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            padding: 0;
            background: none;
        }
        
        .row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        /* Canvas Area */
        .canvas-area {
            flex: 1;
            background: #e2e8f0; /* Darker bg for contrast */
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px;
            position: relative;
        }
        
        /* Grid Background Pattern */
        .canvas-area::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.5;
            pointer-events: none;
        }

        .canvas-page {
            width: var(--page-width);
            min-height: var(--page-height);
            background: white;
            box-shadow: 0 20px 40px -5px rgba(0,0,0,0.1), 0 10px 20px -5px rgba(0,0,0,0.04);
            position: relative;
            transform-origin: top center;
            transition: transform 0.2s ease;
        }

        .draggable-element {
            position: absolute;
            cursor: default; /* Default cursor, move on hover/edit */
            border: 1px dashed transparent;
            min-width: 50px;
            min-height: 20px;
            box-sizing: border-box;
            transition: box-shadow 0.2s, border-color 0.2s;
        }

        /* Edit Mode Styles */
        body.edit-mode .draggable-element {
            cursor: move;
        }
        
        body.edit-mode .draggable-element:hover {
            border-color: var(--primary);
            background: rgba(79, 70, 229, 0.05);
        }

        .draggable-element.selected {
            border: 2px solid var(--primary) !important;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            z-index: 100;
        }

        .text-element {
            width: 100%;
            height: 100%;
            outline: none;
            overflow: hidden;
            white-space: pre-wrap;
            line-height: 1.5;
        }
        
        /* Element Controls */
        .element-controls {
            position: absolute;
            top: -40px;
            right: 0;
            display: none; /* Flex when selected */
            gap: 6px;
            background: white;
            padding: 6px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            z-index: 101;
        }

        .draggable-element.selected .element-controls {
            display: flex;
            animation: fadeIn 0.15s ease;
        }
        
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

        .control-btn {
            width: 28px;
            height: 28px;
            border: 1px solid var(--border);
            border-radius: 4px;
            cursor: pointer;
            background: white;
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
        .control-btn:hover { background: var(--bg-light); color: var(--primary); }
        .control-btn.danger:hover { background: #fef2f2; color: var(--danger); border-color: #fecaca; }

        /* Context Menu */
        .context-menu {
            position: fixed;
            background: white;
            border: 1px solid var(--border);
            border-radius: 8px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            padding: 6px 0;
            z-index: 1000;
            display: none;
            min-width: 160px;
        }

        .context-menu-item {
            padding: 8px 16px;
            cursor: pointer;
            font-size: 13px;
            color: var(--text-main);
            display: flex;
            gap: 8px;
        }

        .context-menu-item:hover {
            background: var(--bg-light);
            color: var(--primary);
        }

        .context-menu-separator {
            height: 1px;
            background: var(--border);
            margin: 4px 0;
        }

        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(255,255,255,0.9);
            z-index: 2000;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: 600;
        }
        .spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(79, 70, 229, 0.2);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 15px;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .hidden { display: none !important; }

    </style>
</head>
<body>

    <div class="loading-overlay" id="globalLoading">
        <div class="spinner"></div>
        <div>جاري تحميل القالب...</div>
    </div>

    <!-- Top Toolbar -->
    <div class="top-toolbar">
        <div class="toolbar-group">
            <div class="toolbar-title">
                ✏️ {{ $templateName }}
            </div>
        </div>
        
        <div class="toolbar-group">
            <button class="toolbar-btn primary" id="editModeBtn">
                <span>🎨</span> وضع التعديل
            </button>
            <button class="toolbar-btn" id="gridBtn">
                <span>📐</span> الشبكة
            </button>
            <div style="width: 1px; height: 24px; background: var(--border); margin: 0 10px;"></div>
            <button class="toolbar-btn" id="undoBtn" disabled>↶</button>
            <button class="toolbar-btn" id="redoBtn" disabled>↷</button>
        </div>
        
        <div class="toolbar-group">
            <button class="toolbar-btn success" id="saveBtn">
                <span>💾</span> حفظ
            </button>
            <button class="toolbar-btn" id="restoreBtn">
                <span>🔄</span> استعادة الافتراضي
            </button>
            <button class="toolbar-btn" id="pdfBtn">
                <span>📄</span> PDF
            </button>
        </div>
    </div>

    <!-- Main Workspace -->
    <div class="editor-workspace">
        <!-- Sidebar -->
        <div class="sidebar-tools">
            <div class="sidebar-content">
                <!-- Add Items -->
                <div class="tool-section">
                    <h3>إضافة عناصر</h3>
                    <div class="tool-grid">
                        <div class="tool-item" data-tool="text">
                            <span class="tool-icon">📝</span>
                            <div class="tool-name">نص</div>
                        </div>
                        <div class="tool-item" data-tool="title">
                            <span class="tool-icon">📰</span>
                            <div class="tool-name">عنوان</div>
                        </div>
                        <div class="tool-item" data-tool="shape">
                            <span class="tool-icon">⬜</span>
                            <div class="tool-name">مربع</div>
                        </div>
                        <div class="tool-item" data-tool="line">
                            <span class="tool-icon">➖</span>
                            <div class="tool-name">خط</div>
                        </div>
                        <div class="tool-item" data-tool="table">
                            <span class="tool-icon">📊</span>
                            <div class="tool-name">جدول</div>
                        </div>
                        <div class="tool-item" data-tool="image">
                            <span class="tool-icon">🖼️</span>
                            <div class="tool-name">صورة</div>
                        </div>
                    </div>
                </div>

                <!-- Properties Panel -->
                <div class="properties-panel" id="propertiesPanel">
                    <h3>خصائص العنصر</h3>
                    
                    <div class="property-group">
                        <div class="row-2">
                            <div>
                                <label class="property-label">X:</label>
                                <input type="number" class="property-input" id="posX">
                            </div>
                            <div>
                                <label class="property-label">Y:</label>
                                <input type="number" class="property-input" id="posY">
                            </div>
                        </div>
                    </div>
                    
                    <div class="property-group">
                         <div class="row-2">
                             <div>
                                 <label class="property-label">العرض:</label>
                                 <input type="number" class="property-input" id="elWidth">
                             </div>
                             <div>
                                 <label class="property-label">الارتفاع:</label>
                                 <input type="number" class="property-input" id="elHeight">
                             </div>
                         </div>
                    </div>

                    <!-- Text Properties -->
                    <div id="textProperties" style="display:none;">
                        <hr style="border:0; border-top:1px solid var(--border); margin: 15px 0;">
                        
                        <div class="property-group">
                            <label class="property-label">النص:</label>
                            <textarea class="property-input" id="textContent" rows="3"></textarea>
                        </div>
                        
                        <div class="property-group">
                            <label class="property-label">الخط:</label>
                            <select class="property-input" id="fontFamily">
                                <option value="Tajawal">Tajawal</option>
                                <option value="Amiri">Amiri</option>
                                <option value="Cairo">Cairo</option>
                                <option value="Arial">Arial</option>
                                <option value="Times New Roman">Times New Roman</option>
                            </select>
                        </div>
                        
                        <div class="property-group">
                            <div class="row-2">
                                <div>
                                    <label class="property-label">الحجم:</label>
                                    <input type="number" class="property-input" id="fontSize" min="8" max="72">
                                </div>
                                <div>
                                    <label class="property-label">الوزن:</label>
                                    <select class="property-input" id="fontWeight">
                                        <option value="normal">عادي</option>
                                        <option value="bold">عريض</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="property-group">
                             <label class="property-label">لون النص:</label>
                             <div class="color-picker-group">
                                 <input type="color" class="color-picker" id="textColor">
                                 <input type="text" class="property-input" id="textColorHex" style="flex:1">
                             </div>
                        </div>
                        
                        <div class="property-group">
                            <label class="property-label">المحاذاة:</label>
                            <select class="property-input" id="textAlign">
                                <option value="right">يمين</option>
                                <option value="center">وسط</option>
                                <option value="left">يسار</option>
                                <option value="justify">ضبط</option>
                            </select>
                        </div>
                    </div>

                    <!-- Shape Properties -->
                    <div id="shapeProperties" style="display:none;">
                        <hr style="border:0; border-top:1px solid var(--border); margin: 15px 0;">
                        <div class="property-group">
                            <label class="property-label">لون الخلفية:</label>
                            <div class="color-picker-group">
                                <input type="color" class="color-picker" id="bgColor">
                                <input type="text" class="property-input" id="bgColorHex" style="flex:1">
                            </div>
                        </div>
                        <div class="property-group">
                            <label class="property-label">لون الحدود:</label>
                            <div class="color-picker-group">
                                <input type="color" class="color-picker" id="borderColor">
                                <input type="text" class="property-input" id="borderColorHex" style="flex:1">
                            </div>
                        </div>
                        <div class="property-group">
                            <div class="row-2">
                                <div>
                                    <label class="property-label">سمك الحدود:</label>
                                    <input type="number" class="property-input" id="borderWidth" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Canvas -->
        <div class="canvas-area">
            <div class="canvas-page" id="canvasPage">
                <!-- Elements will be here -->
            </div>
        </div>
    </div>

    <!-- Context Menu -->
    <div class="context-menu" id="contextMenu">
        <div class="context-menu-item" data-action="duplicate">
            <span>📑</span> تكرار
        </div>
        <div class="context-menu-item" data-action="delete" style="color: var(--danger);">
            <span>🗑️</span> حذف
        </div>
        <div class="context-menu-separator"></div>
        <div class="context-menu-item" data-action="bring-front">
            <span>⬆️</span> إحضار للأمام
        </div>
        <div class="context-menu-item" data-action="send-back">
            <span>⬇️</span> إرسال للخلف
        </div>
    </div>

    <script>
        const TEMPLATE_TYPE = '{{ $templateType }}';
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        let editMode = false;
        let selectedElement = null;
        let elementCounter = 0;
        let undoStack = [];
        let redoStack = [];

        const canvasPage = document.getElementById('canvasPage');
        const propertiesPanel = document.getElementById('propertiesPanel');
        const contextMenu = document.getElementById('contextMenu');

        // Init
        document.addEventListener('DOMContentLoaded', () => {
            loadTemplateSettings();
            setupEventListeners();
        });

        async function loadTemplateSettings() {
            try {
                const response = await fetch(`/admin/templates/load-settings/${TEMPLATE_TYPE}`);
                const data = await response.json();
                
                if (data.success && data.settings) {
                    loadState(data.settings); // Load from DB
                } else {
                    loadDefaultTemplate(TEMPLATE_TYPE); // Fallback to hardcoded defaults
                }
            } catch (error) {
                console.error('Error loading settings:', error);
                loadDefaultTemplate(TEMPLATE_TYPE);
            } finally {
                document.getElementById('globalLoading').classList.add('hidden');
                // Trigger edit mode by default for convenience? No, keep it safe.
                toggleEditMode(true); // Actually, let's enable it by default
            }
        }

        // Toggle Edit Mode
        function toggleEditMode(force) {
            editMode = force !== undefined ? force : !editMode;
            document.body.classList.toggle('edit-mode', editMode);
            const btn = document.getElementById('editModeBtn');
            if (editMode) {
                btn.classList.add('primary');
                btn.innerHTML = '<span>🔒</span> إيقاف التعديل';
            } else {
                btn.classList.remove('primary');
                btn.innerHTML = '<span>🎨</span> وضع التعديل';
                clearSelection();
            }
        }
        document.getElementById('editModeBtn').addEventListener('click', () => toggleEditMode());

        // Basic Tool listeners
        document.querySelectorAll('.tool-item').forEach(item => {
            item.addEventListener('click', () => {
                if (!editMode) {
                    toggleEditMode(true);
                }
                const type = item.dataset.tool;
                addElement(type);
            });
        });

        // Add Element Logic
        function addElement(type, props = {}) {
            const el = document.createElement('div');
            el.className = 'draggable-element';
            el.dataset.id = 'el_' + Date.now() + '_' + Math.floor(Math.random() * 1000);
            el.dataset.type = type;
            
            // Default props usually overwritten by loaded state, otherwise defaults:
            el.style.left = (props.x || 50) + 'px';
            el.style.top = (props.y || 50) + 'px';
            el.style.width = (props.width || (type === 'text' ? 200 : 100)) + 'px';
            el.style.height = (props.height || (type === 'text' ? 50 : 100)) + 'px';
            el.style.zIndex = props.zIndex || 1;

            // Content
            if (type === 'text' || type === 'title') {
                const inner = document.createElement('div');
                inner.className = 'text-element';
                inner.contentEditable = true;
                inner.innerText = props.content || (type === 'title' ? 'عنوان رئيسي' : 'نص جديد');
                inner.style.fontSize = props.fontSize ? props.fontSize + 'px' : (type === 'title' ? '24px' : '16px');
                inner.style.fontWeight = props.fontWeight || (type === 'title' ? 'bold' : 'normal');
                inner.style.textAlign = props.textAlign || 'right';
                inner.style.color = props.color || '#333333';
                inner.style.fontFamily = props.fontFamily || 'Tajawal';
                el.appendChild(inner);
            } else if (type === 'shape') {
                el.style.backgroundColor = props.bgColor || '#e2e8f0';
                el.style.border = `${props.borderWidth || 1}px ${props.borderStyle || 'solid'} ${props.borderColor || '#94a3b8'}`;
            } else if (type === 'line') {
                el.style.height = '2px';
                el.style.backgroundColor = props.bgColor || '#000';
            } else if (type === 'image') {
                el.innerHTML = '<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#eee;color:#999;">صورة</div>';
                // Image handling would be more complex (upload), simplified for now
            }

            // Controls overlay
            const controls = document.createElement('div');
            controls.className = 'element-controls';
            controls.innerHTML = `
                <button class="control-btn" onclick="duplicateElement('${el.dataset.id}')" title="تكرار">📑</button>
                <button class="control-btn danger" onclick="deleteElement('${el.dataset.id}')" title="حذف">🗑️</button>
            `;
            el.appendChild(controls);

            canvasPage.appendChild(el);
            makeInteractive(el);
            
            el.addEventListener('mousedown', (e) => {
                if (!editMode) return;
                e.stopPropagation();
                selectElement(el);
            });
            
            el.addEventListener('contextmenu', (e) => {
                if (!editMode) return;
                e.preventDefault();
                showContextMenu(e.clientX, e.clientY, el);
            });

            if (!props.skipSelect) selectElement(el);
            saveState();
            return el;
        }

        // Interact JS
        function makeInteractive(el) {
            interact(el).draggable({
                listeners: {
                    move(event) {
                        if (!editMode) return;
                        const target = event.target;
                        const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                        const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
                        
                        target.style.transform = `translate(${x}px, ${y}px)`;
                        target.setAttribute('data-x', x);
                        target.setAttribute('data-y', y);
                        
                        // Update visual position attributes for saving (convert transform to left/top or keep transform)
                        // Actually easier to just update left/top on drag end, but for smooth drag we use transform.
                        // For the properties panel, we should show "Computed Left/Top".
                        
                        updatePropertiesPanelValues(); 
                    },
                    end(event) {
                        // Consolidate transform into left/top to keep things clean?
                        // Or keep using transform. Let's stick to simple style usage if possible or just transform.
                        // The user code used transform.
                        saveState();
                    }
                },
                modifiers: [
                    interact.modifiers.restrictRect({
                        restriction: 'parent',
                        endOnly: true
                    })
                ]
            }).resizable({
                edges: { left: true, right: true, bottom: true, top: true },
                listeners: {
                    move(event) {
                        if (!editMode) return;
                        const target = event.target;
                        let x = (parseFloat(target.getAttribute('data-x')) || 0);
                        let y = (parseFloat(target.getAttribute('data-y')) || 0);

                        target.style.width = event.rect.width + 'px';
                        target.style.height = event.rect.height + 'px';

                        x += event.deltaRect.left;
                        y += event.deltaRect.top;

                        target.style.transform = `translate(${x}px, ${y}px)`;
                        target.setAttribute('data-x', x);
                        target.setAttribute('data-y', y);
                        
                        updatePropertiesPanelValues();
                    },
                    end(event) {
                        saveState();
                    }
                }
            });
        }

        // Selection & Properties
        function selectElement(el) {
            clearSelection();
            selectedElement = el;
            el.classList.add('selected');
            
            // Show properties panel
            propertiesPanel.classList.add('active');
            
            const type = el.dataset.type;
            document.getElementById('textProperties').style.display = (type === 'text' || type === 'title') ? 'block' : 'none';
            document.getElementById('shapeProperties').style.display = (type === 'shape') ? 'block' : 'none';
            
            updatePropertiesPanelValues();
        }

        function clearSelection() {
            if (selectedElement) selectedElement.classList.remove('selected');
            selectedElement = null;
            propertiesPanel.classList.remove('active');
            document.getElementById('contextMenu').style.display = 'none';
        }

        function updatePropertiesPanelValues() {
            if (!selectedElement) return;
            const style = window.getComputedStyle(selectedElement);
            
            // Pos & Size
            // Need to account for transform
            const rect = selectedElement.getBoundingClientRect();
            const parentRect = canvasPage.getBoundingClientRect();
            
            // Simple approach: parse inline styles if possible or data attributes
            const x = parseFloat(selectedElement.getAttribute('data-x')) || 0;
            const y = parseFloat(selectedElement.getAttribute('data-y')) || 0;
            const left = parseFloat(selectedElement.style.left) || 0;
            const top = parseFloat(selectedElement.style.top) || 0;
            // Total X = left + transformX
            
            document.getElementById('posX').value = Math.round(left + x);
            document.getElementById('posY').value = Math.round(top + y);
            document.getElementById('elWidth').value = parseInt(selectedElement.style.width);
            document.getElementById('elHeight').value = parseInt(selectedElement.style.height);

            // Text
            const textParams = selectedElement.querySelector('.text-element');
            if (textParams) {
                document.getElementById('textContent').value = textParams.innerText;
                document.getElementById('fontSize').value = parseInt(textParams.style.fontSize);
                document.getElementById('fontFamily').value = textParams.style.fontFamily.replace(/['"]/g, '');
                document.getElementById('textColorHex').value = rgbToHex(textParams.style.color);
                document.getElementById('textColor').value = rgbToHex(textParams.style.color);
            }
            
            // Shape
            if (selectedElement.dataset.type === 'shape') {
                document.getElementById('bgColorHex').value = rgbToHex(selectedElement.style.backgroundColor);
                document.getElementById('bgColor').value = rgbToHex(selectedElement.style.backgroundColor);
                document.getElementById('borderColorHex').value = rgbToHex(selectedElement.style.borderColor);
                document.getElementById('borderColor').value = rgbToHex(selectedElement.style.borderColor);
            }
        }

        // Property Listeners
        // Helper to update selected element style
        function updateSelected(fn) {
            if (selectedElement) {
                fn(selectedElement);
                saveState();
            }
        }
        
        // Text Changes
        document.getElementById('textContent').addEventListener('input', (e) => updateSelected(el => {
            const t = el.querySelector('.text-element'); if(t) t.innerText = e.target.value;
        }));
        document.getElementById('fontSize').addEventListener('input', (e) => updateSelected(el => {
            const t = el.querySelector('.text-element'); if(t) t.style.fontSize = e.target.value + 'px';
        }));
        document.getElementById('fontFamily').addEventListener('change', (e) => updateSelected(el => {
            const t = el.querySelector('.text-element'); if(t) t.style.fontFamily = e.target.value;
        }));
        document.getElementById('fontWeight').addEventListener('change', (e) => updateSelected(el => {
            const t = el.querySelector('.text-element'); if(t) t.style.fontWeight = e.target.value;
        }));
        document.getElementById('textAlign').addEventListener('change', (e) => updateSelected(el => {
            const t = el.querySelector('.text-element'); if(t) t.style.textAlign = e.target.value;
        }));
        
        // Colors
        function updateColor(input, hexInput, styleProp, isText = false) {
            const val = input.value;
            hexInput.value = val;
            updateSelected(el => {
                const target = isText ? el.querySelector('.text-element') : el;
                if (target) target.style[styleProp] = val;
            });
        }
        document.getElementById('textColor').addEventListener('input', (e) => updateColor(e.target, document.getElementById('textColorHex'), 'color', true));
        document.getElementById('bgColor').addEventListener('input', (e) => updateColor(e.target, document.getElementById('bgColorHex'), 'backgroundColor', false));
        document.getElementById('borderColor').addEventListener('input', (e) => updateColor(e.target, document.getElementById('borderColorHex'), 'borderColor', false));
        
        // Size & Pos manual input
        // This is tricky because we use transform for drag. We should probably reset transform and set left/top when manual editing?
        // Or just update transform.
        // For simplicity: Update style.left/top and reset data-x/y to 0
        function updatePos() {
            if (!selectedElement) return;
            const x = parseFloat(document.getElementById('posX').value) || 0;
            const y = parseFloat(document.getElementById('posY').value) || 0;
            const w = parseFloat(document.getElementById('elWidth').value) || 100;
            const h = parseFloat(document.getElementById('elHeight').value) || 100;
            
            selectedElement.style.left = x + 'px';
            selectedElement.style.top = y + 'px';
            selectedElement.style.width = w + 'px';
            selectedElement.style.height = h + 'px';
            
            // Reset transform
            selectedElement.style.transform = 'translate(0px, 0px)';
            selectedElement.setAttribute('data-x', 0);
            selectedElement.setAttribute('data-y', 0);
            saveState();
        }
        
        ['posX','posY','elWidth','elHeight'].forEach(id => {
            document.getElementById(id).addEventListener('change', updatePos);
        });

        // Context Menu & Deletion
        window.deleteElement = function(id) {
            const el = document.querySelector(`.draggable-element[data-id="${id}"]`);
            if (el) {
                el.remove();
                clearSelection();
                saveState();
            }
        };
        
        window.duplicateElement = function(id) {
            const el = document.querySelector(`.draggable-element[data-id="${id}"]`);
            if (el) {
                const clone = el.cloneNode(true);
                clone.dataset.id = 'el_' + Date.now();
                clone.classList.remove('selected');
                
                // Offset
                const currentLeft = parseFloat(el.style.left) || 0;
                const currentTop = parseFloat(el.style.top) || 0;
                const currentX = parseFloat(el.getAttribute('data-x')) || 0;
                const currentY = parseFloat(el.getAttribute('data-y')) || 0;
                
                // Consolidate calc
                clone.style.left = (currentLeft + currentX + 20) + 'px';
                clone.style.top = (currentTop + currentY + 20) + 'px';
                clone.style.transform = 'translate(0px, 0px)';
                clone.setAttribute('data-x', 0);
                clone.setAttribute('data-y', 0);
                
                const controls = clone.querySelector('.element-controls');
                controls.innerHTML = `
                    <button class="control-btn" onclick="duplicateElement('${clone.dataset.id}')" title="تكرار">📑</button>
                    <button class="control-btn danger" onclick="deleteElement('${clone.dataset.id}')" title="حذف">🗑️</button>
                `;
                
                canvasPage.appendChild(clone);
                makeInteractive(clone);
                
                clone.addEventListener('mousedown', (e) => {
                    if (!editMode) return;
                    e.stopPropagation();
                    selectElement(clone);
                });
                clone.addEventListener('contextmenu', (e) => {
                    if (!editMode) return;
                    e.preventDefault();
                    showContextMenu(e.clientX, e.clientY, clone);
                });
                
                selectElement(clone);
                saveState();
            }
        };

        function showContextMenu(x, y, el) {
            contextMenu.style.left = x + 'px';
            contextMenu.style.top = y + 'px';
            contextMenu.style.display = 'block';
            contextMenu.dataset.targetId = el.dataset.id;
        }

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.context-menu')) contextMenu.style.display = 'none';
        });
        
        document.querySelectorAll('.context-menu-item').forEach(item => {
            item.addEventListener('click', () => {
                const id = contextMenu.dataset.targetId;
                const action = item.dataset.action;
                const el = document.querySelector(`[data-id="${id}"]`);
                if (!el) return;
                
                if (action === 'delete') deleteElement(id);
                if (action === 'duplicate') duplicateElement(id);
                if (action === 'bring-front') el.style.zIndex++;
                if (action === 'send-back') el.style.zIndex = Math.max(0, el.style.zIndex - 1);
                
                saveState();
                contextMenu.style.display = 'none';
            });
        });

        // Save & Restore
        document.getElementById('saveBtn').addEventListener('click', async () => {
            const btn = document.getElementById('saveBtn');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<span>⏳</span> جاري الحفظ...';
            btn.disabled = true;
            
            try {
                const settings = serializeState();
                const response = await fetch('/admin/templates/save-settings', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        type: TEMPLATE_TYPE,
                        settings: JSON.stringify(settings)
                    })
                });
                
                const data = await response.json();
                if (data.success) {
                    showModal('تم الحفظ بنجاح!', 'success');
                } else {
                    showModal('خطأ في الحفظ: ' + (data.message || 'Unknown error'), 'error');
                }
            } catch (e) {
                showModal('خطأ في الاتصال', 'error');
                console.error(e);
            } finally {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        });

        document.getElementById('restoreBtn').addEventListener('click', async () => {
            if (confirm('هل أنت متأكد من استعادة القالب الافتراضي؟ سيتم فقد التغييرات الحالية.')) {
                loadDefaultTemplate(TEMPLATE_TYPE);
                saveState();
            }
        });

        // State Management
        function serializeState() {
            return Array.from(canvasPage.querySelectorAll('.draggable-element')).map(el => {
                const type = el.dataset.type;
                const style = el.style;
                // Get computed final pos
                const x = parseFloat(el.getAttribute('data-x')) || 0;
                const y = parseFloat(el.getAttribute('data-y')) || 0;
                const left = parseFloat(style.left) || 0;
                const top = parseFloat(style.top) || 0;

                return {
                    id: el.dataset.id,
                    type: type,
                    x: left + x,
                    y: top + y,
                    width: parseFloat(style.width),
                    height: parseFloat(style.height),
                    zIndex: style.zIndex,
                    // Text specific
                    content: el.querySelector('.text-element')?.innerText,
                    fontSize: el.querySelector('.text-element') ? parseFloat(el.querySelector('.text-element').style.fontSize) : null,
                    fontFamily: el.querySelector('.text-element')?.style.fontFamily,
                    fontWeight: el.querySelector('.text-element')?.style.fontWeight,
                    textAlign: el.querySelector('.text-element')?.style.textAlign,
                    color: el.querySelector('.text-element')?.style.color,
                    // Shape specific
                    bgColor: style.backgroundColor,
                    borderColor: style.borderColor,
                    borderWidth: parseFloat(style.borderWidth),
                    borderStyle: style.borderStyle
                };
            });
        }

        function loadState(elements) {
            // Clear current
            canvasPage.innerHTML = ''; 
            
            if (typeof elements === 'string') elements = JSON.parse(elements);
            
            elements.forEach(data => {
                addElement(data.type, {
                    x: data.x,
                    y: data.y,
                    width: data.width,
                    height: data.height,
                    zIndex: data.zIndex,
                    content: data.content,
                    fontSize: data.fontSize,
                    fontFamily: data.fontFamily,
                    fontWeight: data.fontWeight,
                    textAlign: data.textAlign,
                    color: data.color,
                    bgColor: data.bgColor,
                    borderColor: data.borderColor,
                    borderWidth: data.borderWidth,
                    borderStyle: data.borderStyle,
                    skipSelect: true
                });
            });
        }

        function saveState() {
             // Undo/Redo logic here if needed
        }

        // Default Templates (Fallback)
        function loadDefaultTemplate(type) {
             canvasPage.innerHTML = '';
             let items = [];
             
             if (type === 'negative-certificate') {
                 items = [
                     {type: 'title', content: 'الجمهورية الجزائرية الديمقراطية الشعبية', x: 250, y: 50, textAlign: 'center'},
                     {type: 'title', content: 'المحافظة العقارية', x: 250, y: 100, textAlign: 'center', fontSize: 18},
                     {type: 'title', content: 'شهادة سلبية', x: 250, y: 160, textAlign: 'center', fontSize: 28},
                     {type: 'text', content: 'الاسم: ___________________', x: 400, y: 250},
                     {type: 'text', content: 'اللقب: ___________________', x: 400, y: 300}
                 ];
             } else if (type === 'property-card') {
                 items = [
                     {type: 'title', content: 'بطاقة عقارية', x: 300, y: 50, textAlign: 'center'},
                     {type: 'text', content: 'رقم البطاقة: ...', x: 500, y: 120}
                 ];
             }
             
             loadState(items);
        }

        // Utils
        function rgbToHex(rgb) {
            if (!rgb) return '#000000';
            if (rgb.startsWith('#')) return rgb;
            const res = rgb.match(/\d+/g);
            if (!res) return '#000000';
            return '#' + res.map(x => parseInt(x).toString(16).padStart(2, '0')).join('');
        }
        
        function setupEventListeners() {
             // Undo/Redo shortcuts?
             document.addEventListener('keydown', (e) => {
                 if (e.ctrlKey && e.key === 'z') { e.preventDefault(); /* undo */ }
             });
        }

    </script>
</body>
</html>