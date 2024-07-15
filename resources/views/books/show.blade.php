<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('รายละเอียดหนังสือ') }}
        </h2>
    </x-slot>

    <style>
        .book-details {
            display: flex;
            justify-content: space-between;
        }

        .book-info {
            flex: 1;
            margin-left: 20px; /* ปรับระยะห่างฝั่งซ้าย */
        }

        .book-image {
            max-width: 200px; /* กำหนดความกว้างสูงสุดของรูปภาพ */
        }

        .btn-primary {
            background-color: #3490dc; /* สีพื้นหลัง */
            color: white; /* สีข้อความ */
            padding: 10px 20px; /* การเว้นขอบ */
            border-radius: 5px; /* การทำมุมมน */
            text-decoration: none; /* ลบเส้นใต้ */
        }

        .btn-primary:hover {
            background-color: #2779bd; /* สีพื้นหลังเมื่อวางเมาส์ */
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="book-details">
                        @if ($book->cover_image)
                            <div class="book-image">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="ภาพปกหนังสือ" class="max-w-xs">
                            </div>
                        @endif
                        <div class="book-info">
                            <h3 class="text-xl font-semibold">{{ __('title') }}: {{ $book->title }}</h3>
                            <p class="text-gray-600">{{ __('author') }}: {{ $book->author }}</p>
                            <p class="mt-4">{{ __('description') }}: {{ $book->description }}</p>
                            @if ($book->published_at)
                                <p class="text-gray-500 text-sm mt-2">{{ __('เผยแพร่เมื่อ') }} {{ optional($book->published_at)->format('j F Y') }}</p>
                            @endif
                            <!-- เพิ่มรายละเอียดอื่น ๆ ตามที่ต้องการ -->
                            <br></br>
                            <br></br>
                            <!-- เพิ่มปุ่มไปหน้ายืมหนังสือรายละเอียด -->
                            
                            <a href="{{ route('borrow.details', ['book_id' => $book->id]) }}" class="btn btn-primary mt-3">{{ __('ยืมหนังสือ') }}</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
