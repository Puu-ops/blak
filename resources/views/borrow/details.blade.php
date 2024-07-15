<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('หน้ายืมหนังสือ') }}</h2>
    </x-slot>

    <style>
        .container {
            padding-top: 20px; /* ระยะห่างด้านบน */
        }

        .form-control {
            width: 100%; /* กว้างเต็มคอลัมน์ */
            padding: 10px; /* ระยะห่างขอบฟอร์ม */
            font-size: 1rem; /* ขนาดตัวอักษร */
        }

        .btn-primary {
            margin-top: 10px; /* ระยะห่างด้านบนของปุ่ม */
            font-size: 1rem; /* ขนาดตัวอักษร */
            background-color: #4CAF50; /* สีพื้นหลังปุ่ม */
            color: white; /* สีตัวอักษร */
            border: none; /* ไม่มีเส้นขอบ */
            padding: 10px 20px; /* ขนาดของปุ่ม */
            text-align: center; /* การจัดวางข้อความกึ่งกลาง */
            text-decoration: none; /* ไม่มีการขีดเส้นใต้ข้อความ */
            display: inline-block; /* แสดงเป็นบล็อกแบบ inline */
            cursor: pointer; /* เป็นลูกศรเมาส์ */
            border-radius: 5px; /* รัศมีของมุม */
            transition-duration: 0.4s; /* ความยาวในการเปลี่ยนแปลง */
        }

        .btn-primary:hover {
            background-color: #45a049; /* เมื่อสีเข้า */
            color: white; /* สีตัวอักษร */
        }

        .img-fluid {
            max-width: 100%; /* ขนาดรูปภาพไม่เกินความกว้างของคอลัมน์ */
            height: auto; /* รักษาสัดส่วนของรูปภาพ */
        }

        .book-image {
            max-width: 200px; /* กำหนดความกว้างสูงสุดของรูปภาพ */
            margin: 0 auto; /* จัดให้รูปภาพอยู่ตรงกลาง */
            display: block; /* แสดงเป็นบล็อก */
        }

    </style>

    <!-- เพิ่ม Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- เพิ่ม jQuery และ Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <script>
                            $(document).ready(function() {
                                setTimeout(function() {
                                    $('.alert').alert('close');
                                }, 3000); // 3000 milliseconds = 3 seconds
                            });
                        </script>
                    @endif
                    
                    @if ($book->cover_image)
                        <div class="book-image">
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="ภาพปกหนังสือ" class="img-fluid">
                        </div>
                    @endif
                    <div class="book-info">
                        <h3 class="text-xl font-semibold">ชื่อหนังสือ: {{ $book->title }}</h3>
                        
                        <p>เลือกวันที่คืน:</p>
                        <form method="POST" action="{{ route('borrow.store') }}">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <select name="return_days" class="form-control">
                                <option value="3">คืนภายใน 3 วัน</option>
                                <option value="7">คืนภายใน 7 วัน</option>
                                <option value="14">คืนภายใน 14 วัน</option>
                            </select>
                            <button type="submit" class="btn-primary">ยืมหนังสือ</button>
                        </form>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
