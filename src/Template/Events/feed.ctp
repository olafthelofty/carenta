<?php foreach ($data as $event): ?>
    <tr>
        <td><?= $this->Number->format($event->id) ?></td>
        <td><?= h($event->title) ?></td>
        <td><?= h($event->start) ?></td>
        <td><?= h($event->end) ?></td>
        <td><?= $this->Number->format($event->all_day) ?></td>
        <td><?= h($event->created) ?></td>
        <td><?= h($event->modified) ?></td>
    </tr>
<?php endforeach; ?>