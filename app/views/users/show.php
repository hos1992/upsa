
<div class="card empty_<?= $data['user']->id ?>">
    <div class="card-header">
        <?= strtoupper($data['user']->name); ?>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Card Number</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?= $data['user']->id ?></td>
                <td><?= $data['user']->name ?></td>
                <td><?= $data['user']->email ?></td>
                <td><?= $data['user']->card_number ?></td>
            </tr>
            </tbody>

        </table>

    </div>
</div>