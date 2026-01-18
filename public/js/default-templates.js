export const DEFAULT_TEMPLATES = {
    certificate: {
        version: 2,
        templateType: 'certificate',
        pages: [{
            pageNumber: 1,
            elements: [
                {
                    id: "el_1", type: "title", x: 50, y: 30, style: { width: "500px", height: "40px" },
                    html: '<div class="text-element" style="font-size: 20px; font-weight: bold; text-align: center;">الجمهورية الجزائرية الديمقراطية الشعبية</div>'
                },
                {
                    id: "el_2", type: "title", x: 50, y: 80, style: { width: "500px", height: "35px" },
                    html: '<div class="text-element" style="font-size: 20px; font-weight: bold; text-align: center;">المحافظة العقارية</div>'
                },
                {
                    id: "el_3", type: "title", x: 50, y: 130, style: { width: "500px", height: "30px" },
                    html: '<div class="text-element" style="font-size: 20px; font-weight: bold; text-align: center;">شهادة سلبية</div>'
                },
                {
                    id: "el_4", type: "text", x: 50, y: 200, style: { width: "500px", height: "25px" },
                    html: '<div class="text-element" contenteditable="true">نشهد بأنه لا توجد أي ملكية عقارية مسجلة باسم:</div>'
                },
                {
                    id: "el_5", type: "text", x: 50, y: 250, style: { width: "400px", height: "25px" },
                    html: '<div class="text-element" contenteditable="true">اللقب: {{اللقب}}</div>'
                },
                {
                    id: "el_6", type: "text", x: 50, y: 290, style: { width: "400px", height: "25px" },
                    html: '<div class="text-element" contenteditable="true">الاسم: {{الاسم}}</div>'
                },
                {
                    id: "el_7", type: "text", x: 50, y: 330, style: { width: "400px", height: "25px" },
                    html: '<div class="text-element" contenteditable="true">اسم الأب: {{اسم_الاب}}</div>'
                },
                {
                    id: "el_8", type: "text", x: 50, y: 370, style: { width: "400px", height: "25px" },
                    html: '<div class="text-element" contenteditable="true">تاريخ الميلاد: {{تاريخ_الميلاد}}</div>'
                },
                {
                    id: "el_9", type: "text", x: 50, y: 410, style: { width: "400px", height: "25px" },
                    html: '<div class="text-element" contenteditable="true">مكان الميلاد: {{مكان_الميلاد}}</div>'
                },
                {
                    id: "el_10", type: "signature", x: 50, y: 500, style: { width: "200px", height: "80px" },
                    html: '<div class="text-element" style="border-top: 1px solid #333; padding-top: 10px; text-align: center;">المحافظ العقاري<br>التوقيع والختم</div>'
                }
            ]
        }]
    },
    document: {
        version: 2,
        templateType: 'property-card',
        pages: [{
            pageNumber: 1,
            elements: [
                {
                    id: "el_doc_1", type: "title", x: 50, y: 30, style: { width: "500px", height: "40px" },
                    html: '<div class="text-element" style="font-size: 20px; font-weight: bold; text-align: center;">الجمهورية الجزائرية الديمقراطية الشعبية</div>'
                },
                {
                    id: "el_doc_2", type: "title", x: 50, y: 80, style: { width: "500px", height: "35px" },
                    html: '<div class="text-element" style="font-size: 20px; font-weight: bold; text-align: center;">المحافظة العقارية</div>'
                },
                {
                    id: "el_doc_3", type: "title", x: 50, y: 130, style: { width: "500px", height: "30px" },
                    html: '<div class="text-element" style="font-size: 20px; font-weight: bold; text-align: center;">البطاقة العقارية</div>'
                },
                {
                    id: "el_doc_4", type: "text", x: 50, y: 200, style: { width: "200px", height: "25px" },
                    html: '<div class="text-element" contenteditable="true" style="font-weight:bold;">بيانات مقدم الطلب:</div>'
                },
                {
                    id: "el_doc_5", type: "text", x: 50, y: 230, style: { width: "400px", height: "25px" },
                    html: '<div class="text-element" contenteditable="true">اللقب: {{اللقب}}</div>'
                },
                {
                    id: "el_doc_6", type: "text", x: 50, y: 260, style: { width: "400px", height: "25px" },
                    html: '<div class="text-element" contenteditable="true">الاسم: {{الاسم}}</div>'
                },
                {
                    id: "el_doc_7", type: "text", x: 50, y: 300, style: { width: "200px", height: "25px" },
                    html: '<div class="text-element" contenteditable="true" style="font-weight:bold;">بيانات العقار:</div>'
                },
                {
                    id: "el_doc_8", type: "text", x: 50, y: 330, style: { width: "400px", height: "25px" },
                    html: '<div class="text-element" contenteditable="true">البلدية: {{الموقع}}</div>'
                },
                {
                    id: "el_doc_9", type: "text", x: 50, y: 360, style: { width: "400px", height: "25px" },
                    html: '<div class="text-element" contenteditable="true">رقم المخطط: {{رقم_السند}}</div>'
                },
                {
                    id: "el_doc_10", type: "signature", x: 50, y: 500, style: { width: "200px", height: "80px" },
                    html: '<div class="text-element" style="border-top: 1px solid #333; padding-top: 10px; text-align: center;">المحافظ العقاري<br>التوقيع والختم</div>'
                }
            ]
        }]
    }
};
