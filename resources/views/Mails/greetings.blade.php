<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <title>Greeting</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row g-2">
            <div class="col-lg-6">
                <div class="card p-3 shadow-sm">
                    <form method="POST" action="{{ route('greetings') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <label>Message</label>
                            <textarea id="editor" name="message"></textarea>

                            <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
                            <script>
                                ClassicEditor.create(document.querySelector('#editor'));
                            </script>
                        </div>

                        <div class="form-group mt-3">
                            <label>Files</label>
                            <input type="file" name="attachments[]" multiple accept="image/jpeg,image/png"
                                class="form-control">
                        </div>

                        
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-success">
                                Send Greeting
                            </button>
                        </div>
                        
                    </form>
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @elif
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                </div>
            </div>
            <div class="col-lg-6"></div>
        </div>
    </div>


</body>

</html>