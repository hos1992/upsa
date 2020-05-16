<table class="table table-bordered">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Options</th>

    </tr>
    </thead>
    <tbody>

    <?php if (count($data['users']) > 0): ?>
        <?php $i = 1; ?>
        <?php foreach ($data['users'] as $user) : ?>
            <tr class="empty_<?= $user->id ?>">
                <th scope="row"><?= $i ?></th>
                <td><?= $user->name ?></td>
                <td class="text-center options">

                    <a href="/users/show/<?= $user->id ?>" class="show"><i class="fas fa-eye green-color"></i></a>
                    <a href="/users/edit/<?= $user->id ?>" class="show"><i class="fas fa-edit"></i></a>
                    <a href="/users/delete/<?= $user->id ?>/<?= md5($user->id) ?>" class="dlt_user"><i
                                class="fas fa-trash red-color"></i></a>

                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    </tbody>
</table>
