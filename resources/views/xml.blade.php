<html>
    <body>
        <form method="POST" enctype="multipart/form-data">
            @csrf 
            <input name="xml" type="file">
            <input type="submit">
        </form>
    </body>
</html>