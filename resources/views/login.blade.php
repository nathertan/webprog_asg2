<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Login</title>


<body>
    <div class="pt-5">
        <form action="/login" method="POST">
            @csrf
            <div>
                <input type="text" placeholder="email" id="email" name="email">
            </div>

            <div>
                <input type="password" placeholder="password" id="password" name="password">
            </div>

            <div class="col-md-6 captcha">
                <span>{!! captcha_img() !!}</span>
                <button type="button" class="btn btn-danger" class="reload" id="reload">
                    &#x21bb;
                </button>
            </div>

            <div class="form-group row">
                <div>
                    <input id="captcha" type="text" placeholder="Enter Captcha" name="captcha">

                    @error('captcha')
                    <div class="alert alert-danger" {{ $message }}></div>
                    @enderror
                </div>
            </div>

            <div class="pt-2">
                <input type="submit">
            </div>

        </form>
    </div>

</body>


</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $('#reload').click(function() {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function(data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>