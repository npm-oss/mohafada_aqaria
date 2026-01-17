<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\DocumentsRequest;

class RequestController extends Controller
{
    /**
     * البحث عن البطاقة حسب نوع البطاقة وحالة العقار ومعلومات العقار
     */
    public function searchCard(Request $request)
    {
        // 1️⃣ البحث أولاً عن العقار (بدون card_type)
        $propertyQuery = Property::query();

        if ($request->property_status == 'ممسوح') {
            if($request->section) $propertyQuery->where('section', $request->section);
            if($request->municipality) $propertyQuery->where('municipality', $request->municipality);
            if($request->plan_number) $propertyQuery->where('plan_number', $request->plan_number);
            if($request->parcel_number) $propertyQuery->where('parcel_number', $request->parcel_number);
        } elseif ($request->property_status == 'غير ممسوح') {
            if($request->municipality_ns) $propertyQuery->where('municipality_ns', $request->municipality_ns);
            if($request->subdivision_number) $propertyQuery->where('subdivision_number', $request->subdivision_number);
            if($request->parcel_number_ns) $propertyQuery->where('parcel_number_ns', $request->parcel_number_ns);
        }

        $property = $propertyQuery->first();

        if (!$property) {
            return response()->json([
                'success' => false,
                'message' => 'العقار غير موجود'
            ]);
        }

        // 2️⃣ البحث عن البطاقة المختارة ضمن نفس العقار
        $cardQuery = Property::query()
            ->where('property_status', $property->property_status);

        if($property->property_status == 'surveyed') {
            $cardQuery->where('section', $property->section)
                      ->where('municipality', $property->municipality)
                      ->where('plan_number', $property->plan_number)
                      ->where('parcel_number', $property->parcel_number);
        } else {
            $cardQuery->where('municipality_ns', $property->municipality_ns)
                      ->where('subdivision_number', $property->subdivision_number)
                      ->where('parcel_number_ns', $property->parcel_number_ns);
        }

        // فقط البطاقة المختارة
        if($request->card_type) {
            $cardQuery->where('card_type', $request->card_type);
        }

        $card = $cardQuery->first();

        if (!$card) {
            return response()->json([
                'success' => false,
                'message' => 'هذه البطاقة غير موجودة لهذا العقار'
            ]);
        }

        return response()->json(['success' => true, 'card' => $card]);
    }

    /**
     * عرض صفحة معالجة الطلب
     */
    public function process($id)
    {
        $request = DocumentsRequest::findOrFail($id); // الطلب الأصلي
        return view('admin.documents.process', compact('request'));
    }
}
