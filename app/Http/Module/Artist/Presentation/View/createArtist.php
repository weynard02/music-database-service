<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArtistForm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="icon.png" type="icon">
  </head>
  <body>
    <div class="d-flex align-items-center justify-content-center">
        <form action="create_artist" method="POST" enctype="multipart/form-data">
                <h2>Song Form</h2>
                <div class="mb-3">
                    <label for="name" class="form-label">Name <sup>*</sup></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name...">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3" name="description" placeholder="Max 255 charaters" ></textarea>
                </div>
                <div class="mb-3">
                    <input type="checkbox" id="is_verified" name="is_verified" value="Bike">
                    <label for="is_verified"> is Verified</label><br>
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>