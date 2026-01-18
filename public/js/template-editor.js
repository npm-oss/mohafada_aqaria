// ======= إعدادات عامة =======
const workspace = document.getElementById('workspace');
const btnEdit = document.getElementById('btnEdit');
const btnSave = document.getElementById('btnSave');
const btnReset = document.getElementById('btnReset');
const btnAddPage = document.getElementById('btnAddPage');
const btnRemovePage = document.getElementById('btnRemovePage');
const btnExportJson = document.getElementById('btnExportJson');
const btnImportJson = document.getElementById('btnImportJson');
const btnPreview = document.getElementById('btnPreview');
const fileImport = document.getElementById('fileImport');
const pageIndicator = document.getElementById('pageIndicator');

let editMode = false;
let selectedEl = null;
let pages = [];
let currentPageIndex = 0;

// ======= إدارة الصفحات =======
function createPage(pageNumber) {
  const page = document.createElement('div');
  page.className = 'page';
  page.dataset.pageNumber = pageNumber;
  
  const pageNum = document.createElement('div');
  pageNum.className = 'page-number';
  pageNum.textContent = `صفحة ${pageNumber}`;
  page.appendChild(pageNum);
  
  // محتوى افتراضي
  const content = document.createElement('div');
  content.className = 'movable';
  content.dataset.id = `page-${pageNumber}-content`;
  content.innerHTML = `
    <div class="topbar">
      <div class="form-no movable" data-id="form-no-${pageNumber}" data-editable="1">عدد 1 م.ع.<br>مكرر</div>
      <h1 class="title movable" data-id="title-${pageNumber}" data-editable="1">إدارة الأملاك الوطنية</h1>
    </div>
    <div class="movable" data-id="content-${pageNumber}" data-editable="1" style="margin-top: 20mm;">
      <p>محتوى الصفحة ${pageNumber}</p>
      <p>يمكنك تعديل هذا النص وإضافة المزيد من العناصر</p>
    </div>
  `;
  
  page.appendChild(content);
  return page;
}

function addPage() {
  const pageNumber = pages.length + 1;
  const page = createPage(pageNumber);
  workspace.appendChild(page);
  pages.push(page);
  updatePageIndicator();
  enableInteractForPage(page);
}

function removePage() {
  if (pages.length <= 1) {
    alert('يجب أن يحتوي القالب على صفحة واحدة على الأقل');
    return;
  }
  
  if (confirm(`هل تريد حذف الصفحة ${pages.length}؟`)) {
    const lastPage = pages.pop();
    workspace.removeChild(lastPage);
    updatePageIndicator();
  }
}

function updatePageIndicator() {
  pageIndicator.textContent = `صفحة ${currentPageIndex + 1} من ${pages.length}`;
}

// ======= مساعدة: تطبيق transform =======
function setTranslate(el, x, y) {
  el.dataset.x = String(x);
  el.dataset.y = String(y);
  el.style.transform = `translate(${x}px, ${y}px)`;
}

function getXY(el) {
  return {
    x: parseFloat(el.dataset.x || '0') || 0,
    y: parseFloat(el.dataset.y || '0') || 0
  };
}

// ======= تحديد عنصر =======
function clearSelection() {
  document.querySelectorAll('.movable.selected').forEach(e => e.classList.remove('selected'));
  selectedEl = null;
}

function selectEl(el) {
  clearSelection();
  selectedEl = el;
  el.classList.add('selected');
  el.focus?.();
}

// ======= interact.js: سحب + تغيير حجم =======
function enableInteractForPage(page) {
  const movables = page.querySelectorAll('.movable');
  
  movables.forEach(el => {
    interact(el)
      .draggable({
        listeners: {
          start(event) {
            if (!editMode) return;
            selectEl(event.target);
          },
          move(event) {
            if (!editMode) return;
            const target = event.target;
            const pos = getXY(target);
            const x = pos.x + event.dx;
            const y = pos.y + event.dy;
            setTranslate(target, x, y);
          }
        }
      })
      .resizable({
        edges: { left: true, right: true, bottom: true, top: true },
        listeners: {
          start(event) {
            if (!editMode) return;
            selectEl(event.target);
          },
          move(event) {
            if (!editMode) return;
            const target = event.target;
            const { width, height } = event.rect;
            target.style.width = width + 'px';
            target.style.height = height + 'px';
            
            const pos = getXY(target);
            const x = pos.x + event.deltaRect.left;
            const y = pos.y + event.deltaRect.top;
            setTranslate(target, x, y);
          }
        },
        modifiers: [
          interact.modifiers.restrictSize({
            min: { width: 40, height: 18 }
          })
        ]
      });
    
    el.addEventListener('pointerdown', (e) => {
      if (!editMode) return;
      e.stopPropagation();
      selectEl(el);
    });
  });
}

function enableInteract() {
  pages.forEach(page => enableInteractForPage(page));
  
  workspace.addEventListener('pointerdown', () => {
    if (!editMode) return;
    clearSelection();
  });
}

// ======= تفعيل/إلغاء التعديل =======
function setEditable(on) {
  document.querySelectorAll('[data-editable="1"]').forEach(el => {
    el.setAttribute('contenteditable', on ? 'true' : 'false');
  });
}

function setEditMode(on) {
  editMode = on;
  document.body.classList.toggle('edit-on', on);
  
  btnSave.disabled = !on;
  btnReset.disabled = !on;
  btnAddPage.disabled = !on;
  btnRemovePage.disabled = !on;
  btnExportJson.disabled = !on;
  btnImportJson.disabled = !on;
  btnPreview.disabled = !on;
  
  btnEdit.textContent = on ? 'إيقاف وضع التعديل' : 'تفعيل وضع التعديل';
  setEditable(on);
  
  if (!on) {
    clearSelection();
  }
}

// ======= حفظ/تحميل الحالة =======
function captureState() {
  const state = {
    version: 2,
    templateType: window.TEMPLATE_TYPE,
    pages: []
  };
  
  pages.forEach((page, pageIndex) => {
    const pageState = {
      pageNumber: pageIndex + 1,
      elements: []
    };
    
    page.querySelectorAll('[data-id]').forEach(el => {
      const id = el.getAttribute('data-id');
      const { x, y } = getXY(el);
      
      const item = {
        id,
        x, y,
        style: {
          width: el.style.width || null,
          height: el.style.height || null
        },
        html: (el.getAttribute('data-editable') === '1') ? el.innerHTML : null
      };
      
      pageState.elements.push(item);
    });
    
    state.pages.push(pageState);
  });
  
  return state;
}

function applyState(state) {
  if (!state || !state.pages) return;
  
  // حذف الصفحات الحالية
  while (pages.length > 0) {
    const page = pages.pop();
    workspace.removeChild(page);
  }
  
  // إنشاء الصفحات من الحالة
  state.pages.forEach((pageState, index) => {
    addPage();
    const page = pages[index];
    
    pageState.elements.forEach(item => {
      const el = page.querySelector(`[data-id="${CSS.escape(item.id)}"]`);
      if (!el) return;
      
      setTranslate(el, item.x || 0, item.y || 0);
      
      if (item.style) {
        el.style.width = item.style.width || '';
        el.style.height = item.style.height || '';
      }
      
      if (item.html != null && el.getAttribute('data-editable') === '1') {
        el.innerHTML = item.html;
      }
    });
  });
  
  updatePageIndicator();
}

// ======= حفظ على السيرفر =======
async function saveToServer() {
  const state = captureState();
  
  try {
    const response = await fetch(`/admin/templates/save-settings`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': window.CSRF_TOKEN
      },
      body: JSON.stringify({
        type: window.TEMPLATE_TYPE,
        settings: JSON.stringify(state)
      })
    });
    
    const result = await response.json();
    
    if (result.success) {
      alert('✅ ' + result.message);
    } else {
      alert('❌ فشل الحفظ: ' + result.message);
    }
  } catch (error) {
    console.error(error);
    alert('❌ حدث خطأ أثناء الحفظ');
  }
}

// ======= تحميل من السيرفر =======
async function loadFromServer() {
  try {
    const response = await fetch(`/admin/templates/load-settings/${window.TEMPLATE_TYPE}`);
    const result = await response.json();
    
    if (result.success && result.settings) {
      applyState(result.settings);
      console.log('✅ تم تحميل القالب المحفوظ');
    }
  } catch (error) {
    console.error(error);
  }
}

// ======= استعادة الافتراضي =======
async function restoreDefault() {
  if (!confirm('هل تريد استعادة القالب الافتراضي؟ سيتم حذف جميع التعديلات.')) {
    return;
  }
  
  try {
    const response = await fetch(`/admin/templates/restore/${window.TEMPLATE_TYPE}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': window.CSRF_TOKEN
      }
    });
    
    const result = await response.json();
    
    if (result.success) {
      alert('✅ ' + result.message);
      location.reload();
    } else {
      alert('❌ ' + result.message);
    }
  } catch (error) {
    console.error(error);
    alert('❌ حدث خطأ');
  }
}

// ======= الأحداث =======
btnEdit.addEventListener('click', () => setEditMode(!editMode));
btnSave.addEventListener('click', saveToServer);
btnReset.addEventListener('click', restoreDefault);
btnAddPage.addEventListener('click', addPage);
btnRemovePage.addEventListener('click', removePage);

btnExportJson.addEventListener('click', () => {
  const state = captureState();
  const blob = new Blob([JSON.stringify(state, null, 2)], { type: 'application/json' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = `template-${window.TEMPLATE_TYPE}.json`;
  document.body.appendChild(a);
  a.click();
  a.remove();
  URL.revokeObjectURL(url);
});

btnImportJson.addEventListener('click', () => fileImport.click());

fileImport.addEventListener('change', async (e) => {
  const file = e.target.files?.[0];
  if (!file) return;
  
  try {
    const text = await file.text();
    const state = JSON.parse(text);
    applyState(state);
    alert('✅ تم الاستيراد بنجاح');
  } catch (err) {
    console.error(err);
    alert('❌ فشل الاستيراد');
  } finally {
    fileImport.value = '';
  }
});

btnPreview.addEventListener('click', () => {
  window.print();
});

// ======= تحريك بالأسهم =======
window.addEventListener('keydown', (e) => {
  if (!editMode || !selectedEl) return;
  
  const step = e.shiftKey ? 10 : 1;
  let { x, y } = getXY(selectedEl);
  
  if (e.key === 'ArrowLeft') { x -= step; e.preventDefault(); }
  if (e.key === 'ArrowRight') { x += step; e.preventDefault(); }
  if (e.key === 'ArrowUp') { y -= step; e.preventDefault(); }
  if (e.key === 'ArrowDown') { y += step; e.preventDefault(); }
  
  setTranslate(selectedEl, x, y);
});

// ======= التهيئة =======
function init() {
  // إنشاء صفحة واحدة افتراضياً
  addPage();
  enableInteract();
  setEditMode(false);
  
  // تحميل القالب المحفوظ
  loadFromServer();
}

// بدء التطبيق
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', init);
} else {
  init();
}