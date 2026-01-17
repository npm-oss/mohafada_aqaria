@extends('admin.layout')

@section('content')

<!-- Animations + Glow + Pulse CSS -->
<style>
@keyframes fadeSlide {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fadeSlide { animation: fadeSlide 0.8s ease forwards; }

@keyframes pulse {
    0%,100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}
.animate-pulse-slow { animation: pulse 2s infinite; }

.hover-glow:hover { box-shadow: 0 10px 25px rgba(59,130,246,0.5); }
</style>

<div class="space-y-10">

    <!-- الترحيب -->
    <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white p-6 rounded-xl shadow-xl text-right animate-fadeSlide">
        <h1 class="text-3xl font-bold">مرحبا بك في لوحة الإدارة</h1>
        <p class="mt-2 text-sm opacity-90">نظرة شاملة على الطلبات والمستخدمين</p>
    </div>

    <!-- البطاقات الدائرية للإحصائيات -->
    <div class="grid grid-cols-4 gap-8 justify-items-center">
        <!-- طلبات جديدة مع Pulse -->
        <div class="w-44 h-44 bg-gradient-to-br from-blue-600 to-blue-500 text-white rounded-full shadow-lg flex flex-col items-center justify-center transform hover:scale-110 hover-glow animate-fadeSlide animate-pulse-slow" style="animation-delay:0.1s;">
            <div class="text-4xl font-bold">{{ $newRequests ?? 0 }}</div>
            <div class="mt-2 text-lg font-medium text-center">📄 طلبات جديدة</div>
            <div class="mt-2 w-3/4 h-2 bg-blue-200 rounded-full">
                <div class="h-2 bg-blue-800 rounded-full" style="width: {{ $newPercent ?? 0 }}%"></div>
            </div>
        </div>

        <!-- قيد المعالجة -->
        <div class="w-44 h-44 bg-gradient-to-br from-blue-500 to-blue-400 text-white rounded-full shadow-lg flex flex-col items-center justify-center transform hover:scale-110 hover-glow animate-fadeSlide" style="animation-delay:0.2s;">
            <div class="text-4xl font-bold">{{ $processingRequests ?? 0 }}</div>
            <div class="mt-2 text-lg font-medium text-center">⏳ قيد المعالجة</div>
            <div class="mt-2 w-3/4 h-2 bg-blue-200 rounded-full">
                <div class="h-2 bg-blue-800 rounded-full" style="width: {{ $processingPercent ?? 0 }}%"></div>
            </div>
        </div>

        <!-- مقبولة -->
        <div class="w-44 h-44 bg-gradient-to-br from-blue-400 to-blue-300 text-white rounded-full shadow-lg flex flex-col items-center justify-center transform hover:scale-110 hover-glow animate-fadeSlide" style="animation-delay:0.3s;">
            <div class="text-4xl font-bold">{{ $approvedRequests ?? 0 }}</div>
            <div class="mt-2 text-lg font-medium text-center">✔️ مقبولة</div>
            <div class="mt-2 w-3/4 h-2 bg-blue-200 rounded-full">
                <div class="h-2 bg-blue-800 rounded-full" style="width: {{ $approvedPercent ?? 0 }}%"></div>
            </div>
        </div>

        <!-- المستخدمين -->
        <div class="w-44 h-44 bg-gradient-to-br from-blue-300 to-blue-200 text-white rounded-full shadow-lg flex flex-col items-center justify-center transform hover:scale-110 hover-glow animate-fadeSlide" style="animation-delay:0.4s;">
            <div class="text-4xl font-bold">{{ $usersCount ?? 0 }}</div>
            <div class="mt-2 text-lg font-medium text-center">👤 المستخدمين</div>
        </div>
    </div>

    <!-- Search للطلبات -->
    <div class="flex justify-between items-center bg-white p-4 rounded-xl shadow-lg animate-fadeSlide" style="animation-delay:0.5s;">
        <input type="text" placeholder="ابحث عن طلب..." class="border border-gray-300 rounded-lg px-3 py-2 w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <div class="text-sm text-gray-500">إجمالي الطلبات: {{ $latestRequests->count() ?? 0 }}</div>
    </div>

    <!-- آخر الطلبات -->
    <div class="bg-white p-6 rounded-xl shadow-lg animate-fadeSlide hover-glow" style="animation-delay:0.6s;">
        <h2 class="text-2xl font-bold mb-4">📋 آخر الطلبات</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200 text-center">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="py-2 px-4 border">الرقم</th>
                        <th class="py-2 px-4 border">المواطن</th>
                        <th class="py-2 px-4 border">نوع الطلب</th>
                        <th class="py-2 px-4 border">الحالة</th>
                        <th class="py-2 px-4 border">الإجراءات</th>
                        <th class="py-2 px-4 border">التاريخ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestRequests as $request)
                    <tr class="hover:bg-blue-50 transition animate-fadeSlide" style="animation-delay:0.7s;">
                        <td class="py-2 px-4 border">{{ $request->id }}</td>
                        <td class="py-2 px-4 border">{{ $request->user_id }}</td>
                        <td class="py-2 px-4 border">{{ $request->type }}</td>
                        <td class="py-2 px-4 border">
                            @if($request->status == 'new')
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">جديد</span>
                            @elseif($request->status == 'processing')
                                <span class="bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-sm">قيد المعالجة</span>
                            @else
                                <span class="bg-blue-300 text-blue-900 px-3 py-1 rounded-full text-sm">مقبول</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border">
                            <a href="{{ route('admin.requests.show', $request->id) }}" class="text-blue-600 hover:underline">👁️ عرض</a>
                            <a href="{{ route('admin.requests.edit', $request->id) }}" class="text-blue-700 hover:underline ml-2">⚙️ معالجة</a>
                        </td>
                        <td class="py-2 px-4 border">{{ $request->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td class="py-2 px-4 border" colspan="6">لا توجد طلبات حاليا</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Activity Feed -->
    <div class="bg-white p-6 rounded-xl shadow-lg animate-fadeSlide hover-glow" style="animation-delay:0.8s;">
        <h2 class="text-2xl font-bold mb-4">📝 آخر النشاطات</h2>
        <ul class="space-y-2 max-h-48 overflow-y-auto">
            @forelse($activities as $activity)
            <li class="flex justify-between items-center border-b py-1">
                <span>{{ $activity->description }}</span>
                <span class="text-xs text-gray-400">{{ $activity->created_at->diffForHumans() }}</span>
            </li>
            @empty
            <li class="text-gray-400">لا توجد نشاطات حاليا</li>
            @endforelse
        </ul>
    </div>

    <!-- قائمة عمودية على الجهة اليمنى للأزرار السريعة -->
    <div class="flex justify-end mt-6">
        <div class="space-y-4">
            <a href="{{ route('admin.requests.create') }}" class="relative w-64 h-16 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-full shadow-lg flex items-center justify-center text-center text-lg font-bold hover:scale-105 transform transition duration-500 hover-glow animate-fadeSlide animate-pulse-slow" style="animation-delay:0.9s;">
                ➕ معالجة طلب جديد
                @if($newRequests>0)
                <span class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">{{ $newRequests }}</span>
                @endif
            </a>
            <a href="{{ route('admin.certificates.index') }}" class="w-64 h-16 bg-gradient-to-r from-blue-400 to-blue-500 text-white rounded-full shadow-lg flex items-center justify-center text-center text-lg font-bold hover:scale-105 transform transition duration-500 hover-glow animate-fadeSlide" style="animation-delay:1s;">
                📄 الشهادات السلبية
            </a>
            <a href="{{ route('admin.documents.index') }}" class="w-64 h-16 bg-gradient-to-r from-blue-300 to-blue-400 text-white rounded-full shadow-lg flex items-center justify-center text-center text-lg font-bold hover:scale-105 transform transition duration-500 hover-glow animate-fadeSlide" style="animation-delay:1.1s;">
                📑 الوثائق العقارية
            </a>
            <a href="{{ route('admin.messages.index') }}" class="relative w-64 h-16 bg-gradient-to-r from-blue-200 to-blue-300 text-white rounded-full shadow-lg flex items-center justify-center text-center text-lg font-bold hover:scale-105 transform transition duration-500 hover-glow animate-fadeSlide" style="animation-delay:1.2s;">
                📩 الرسائل الجديدة
                @if($unreadMessages>0)
                <span class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">{{ $unreadMessages }}</span>
                @endif
            </a>
        </div>
    </div>

</div>

@endsection
