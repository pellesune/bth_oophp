<?php
namespace Anax\View;

if (!$res) {
    return;
}
// echo showEnvironment(get_defined_vars(), get_defined_functions());
// var_dump($res);
?><h1>Admin</h1><br>
<table>
    <tr class="first">
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Published</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Deleted</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
<?php $id = -1; foreach ($res as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->type ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
            <td>
                  <a href="edit?id=<?= $row->id ?>" title="Edit" style="color:green"><i class="fa fa-edit" aria-hidden="true"></i></a>
            </td>
            <td>
              |
            </td>
            <td>
                    <a href="delete?id=<?= $row->id ?>" title="Delete" style="color:red"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
    </tr>
<?php endforeach; ?>
</table>
<p>
  <a href="add" title="Add" style="color:black"><i class="fa fa-plus-square fa-3x" aria-hidden="true"></i></a>
</p>
