@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-xl font-bold mb-4">Ubah Kategori</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category) }}"
          method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Nama Kategori</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $category->name) }}"
                   class="mt-1 block w-full rounded-md border-gray-300"
                   required>
        </div>

        <button type="submit"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md">
            Simpan Perubahan
        </button>

        <a href="{{ route('categories.index') }}"
           class="text-gray-600 ml-2">
            Batal
        </a>
    </form>
</div>
@endsection