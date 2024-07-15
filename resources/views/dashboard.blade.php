<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book List') }}
        </h2>
    </x-slot>

    <style>
        /* สไตล์สำหรับแสดงหนังสือ */
        .book-card {
            border: none; /* ลบเส้นขอบของกล่องหนังสือ */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* เพิ่มเงาใต้กล่อง */
            padding: 1rem; /* ระยะห่างของข้อความภายในกล่อง */
            display: flex; /* แสดงเป็น Flexbox */
            flex-direction: column; /* จัดเรียงแนวตั้ง */
            align-items: center; /* จัดตำแหน่งกล่องภายในตามแนวนอน */
            text-align: center; /* จัดตำแหน่งข้อความกึ่งกลาง */
            margin-bottom: 1rem; /* ระยะห่างด้านล่างของกล่องหนังสือ */
            transition: transform 0.2s; /* เพิ่มเอฟเฟคการเคลื่อนที่ */
            position: relative; /* เพิ่มความสามารถในการส่งค่าแบบอาร์กิวเมนต์ไปที่ลิงค์ */
            cursor: pointer; /* เพิ่มเคอร์เซอร์เป็นตัวชี้ */
        }

        .book-card::before {
            content: ""; /* เพิ่ม content ว่างเพื่อสร้างพื้นที่ให้รูปมือกด */
            position: absolute; /* ตำแหน่งอยู่ตรงกลาง */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.1); /* เพิ่มความโปร่งใส */
            z-index: 1; /* การจัดเรียงด้านหน้า */
            opacity: 0; /* ความเข้ม */
            transition: opacity 0.3s ease-in-out; /* ความโปร่งใส */
        }

        .book-card:hover::before {
            opacity: 1; /* แสดงรูปมือกด */
        }

        .book-card img {
            width: 150px; /* กำหนดความกว้างของรูป */
            height: auto; /* ให้ความสูงปรับตามกว้าง */
            margin-bottom: 0.5rem; /* ระยะห่างระหว่างรูปและข้อความ */
            z-index: 2; /* การจัดเรียงด้านหน้า */
        }

        .book-card-title {
            font-size: 1rem; /* ขนาดตัวอักษรของชื่อหนังสือ */
            font-weight: bold; /* ตัวหนา */
            margin-bottom: 0.5rem; /* ระยะห่างระหว่างชื่อและรายละเอียด */
            position: relative; /* ตำแหน่ง */
            z-index: 2; /* การจัดเรียงด้านหน้า */
            color: #000000; /* สีของข้อความ */
        }

        .book-card:hover {
            transform: translateY(-5px); /* เคลื่อนที่กล่องขึ้นไปเล็กน้อย */
        }

        /* เปลี่ยนการจัดวางของ Grid เป็นแนวนอน */
        @media (min-width: 640px) {
            .grid-cols-1 {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }
    </style>

    <!-- เพิ่ม jQuery และ Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- แสดงข้อความ Alert เมื่อมี session 'alert' -->
    <div class="container mt-4">
        @if(session('alert'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('alert') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                // ปิด Alert หลังจาก 3 วินาที
                setTimeout(function() {
                    $('.alert').alert('close');
                }, 3000);
            </script>
        @endif
    </div>

    <!-- แสดงรายการหนังสือ -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($books as $book)
                            <div class="book-card" onclick="window.location.href='{{ route('books.show', ['book' => $book->id]) }}';">
                                @if ($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Book Cover">
                                @else
                                    <span>No Image</span>
                                @endif
                                <div class="book-card-title">{{ Str::limit($book->title, 30) }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
