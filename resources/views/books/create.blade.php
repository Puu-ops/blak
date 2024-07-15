<!-- resources/views/books/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Book') }}
        </h2>
    </x-slot>

    <style>
        /* Custom styles for this page */
        .input-field {
            margin-top: 1rem;
        }

        .input-field label {
            font-weight: bold;
            font-size: 1.1rem;
            color: #333;
        }

        .input-field input[type="text"],
        .input-field textarea,
        .input-field input[type="file"],
        .input-field select {
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }

        .input-field input[type="text"]:focus,
        .input-field textarea:focus,
        .input-field input[type="file"]:focus,
        .input-field select:focus {
            border-color: #4a90e2;
            outline: none;
        }

        .submit-btn {
            background-color: #4a90e2;
            color: #fff;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #357bd8;
        }

        .error-message {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 0.75rem 1rem;
            border-radius: 4px;
            margin-top: 1rem;
        }

        .success-message {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 0.75rem 1rem;
            border-radius: 4px;
            margin-top: 1rem;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="error-message">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                
                        <script>
                            $(document).ready(function() {
                                setTimeout(function() {
                                    $('.error-message').fadeOut('slow');
                                }, 3000); // 3000 milliseconds = 3 seconds
                            });
                        </script>
                    @endif

                    @if (session('success'))
                        <div class="success-message">
                            {{ session('success') }}
                            
                        </div>

                        <script>
                            $(document).ready(function() {
                                setTimeout(function() {
                                    $('.success-message').fadeOut('slow', function() {
                                        $(this).remove(); // ลบ element ทิ้งหลังจากที่ fade out เสร็จ
                                    });
                                }, 3000); // 3000 milliseconds = 3 seconds
                            });
                        </script>
                    @endif

            

                    <form id="bookForm" action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="input-field">
                            <label for="title" class="block">{{ __('Title') }}</label>
                            <input id="title" class="block" type="text" name="title" value="{{ old('title') }}" required autofocus />
                        </div>

                        <!-- Author -->
                        <div class="input-field">
                            <label for="author" class="block">{{ __('Author') }}</label>
                            <input id="author" class="block" type="text" name="author" value="{{ old('author') }}" required />
                        </div>

                        <!-- Description -->
                        <div class="input-field">
                            <label for="description" class="block">{{ __('Description') }}</label>
                            <textarea id="description" name="description" rows="6" class="block" placeholder="Book description">{{ old('description') }}</textarea>
                        </div>

                        <!-- Category -->
                        <div class="input-field">
                            <label for="category">{{ __('Category') }}</label>
                            <select id="category" name="category" required>
                                <option value="">{{ __('Select Category') }}</option>
                                <option value="การ์ตูน">หนังสือการ์ตูน</option>
                                <option value="นวนิยาย">นวนิยาย</option>
                                <option value="สารคดี">สารคดี</option>
                                <option value="วรรณกรรม">วรรณกรรม</option>
                                <option value="จิตวิทยา">จิตวิทยา</option>
                                <option value="แม่และเด็ก">แม่และเด็ก</option>
                                <option value="บริหารธุรกิจ">บริหารธุรกิจ</option>
                                <option value="อื่นๆ">อื่นๆ</option>
                            </select>
                        </div>

                        <!-- Image -->
                        <div class="input-field">
                            <label for="image" class="block">{{ __('Book Image') }}</label>
                            <input id="image" class="block" type="file" name="image" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="submit-btn">
                                {{ __('Add Book') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
