<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Product Import & Export</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-100 flex items-center justify-center h-screen">

        <div class="bg-white p-8 rounded-lg shadow-md w-96">
            <h2 class="text-xl font-semibold text-gray-700 text-center mb-4">Import & Export Products</h2>

            <!-- Import Form -->
            <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <label class="block">
                    <span class="text-gray-700">Upload File</span>
                    <input type="file" name="file" required
                        class="mt-2 block w-full px-3 py-2 border rounded-lg text-gray-700 bg-gray-50">
                </label>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    Import Products
                </button>
            </form>

            <!-- Export Button -->
            <div class="mt-4 text-center">
                <a href="{{ route('products.export') }}" class="text-blue-600 hover:underline">Export Products</a>
            </div>
        </div>

    </body>

</html>
