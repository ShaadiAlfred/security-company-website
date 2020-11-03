<html>
    <head>

    </head>
    <body>

        <form method="POST" action="{{ route('employees.storeFromExcel') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="excel_files[]" multiple />
            <button type="submit">Submit</button>
        </form>

    </body>
</html>
