<div class="card empty_<?= $data['user']->id ?>">
    <div class="card-header">
        Update user account
    </div>
    <div class="card-body">


        <form action="/users/edit_post/<?= $data['user']->id ?>" id="submit" method="post"
              enctype="multipart/form-data">

            <div class="msg">

            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" value="<?= $data['user']->name ?>">
                    <span class="error error-name"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" value="<?= $data['user']->email ?>">
                    <span class="error error-email"></span>
                </div>
            </div>


            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="password">
                    <span class="error error-password"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="card_number" class="col-sm-2 col-form-label">card number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="card_number" id="card_number" value="<?= $data['user']->card_number ?>">
                    <span class="error error-card_number"></span>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" id="submit_btn" class="btn btn-primary">Save</button>
            </div>

        </form>

    </div>
</div>