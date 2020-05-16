<div class="card">
    <div class="card-header">
        create new user account
    </div>
    <div class="card-body">


        <form action="/users/create_post" id="submit" method="post" enctype="multipart/form-data">

            <div class="msg">

            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name">
                    <span class="error error-name"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email">
                    <span class="error error-email"></span>
                </div>
            </div>


            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="inputPassword">
                    <span class="error error-password"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="card_number" class="col-sm-2 col-form-label">card number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="card_number" id="card_number">
                    <span class="error error-card_number"></span>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" id="submit_btn" class="btn btn-primary">Save</button>
            </div>

        </form>

    </div>
</div>