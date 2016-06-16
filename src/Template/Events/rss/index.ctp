<?php

$this->set('channelData', [
    'title' => __("Most Recent Posts"),
    'link' => $this->Url->build('/', true),
    'description' => __("Most recent pooooosts."),
    'language' => 'en-us',
]);

foreach ($events as $event) {
    $created = strtotime($event->created);
    $start = date('d-m-Y',strtotime($event->startdate));
    $end = date('d-m-Y',strtotime($event->enddate));

    $link = [
        'controller' => 'Events',
        'action' => 'view',
        'year' => date('Y', $created),
        'month' => date('m', $created),
        'day' => date('d', $created),
        'slug' => $event->title
    ];
    
    // Remove & escape any HTML to make sure the feed content will validate.
    $body = h(strip_tags('Start ' . $start . ' ' . 'End ' . $end));
    $body = $this->Text->truncate($body, 400, [
        'ending' => '...',
        'exact'  => true,
        'html'   => true,
    ]);

    echo  $this->Rss->item([], [
        'title' => 'New leave booked for ' . $event->title,
        //'link' => $link,
        //'guid' => ['url' => $link, 'isPermaLink' => 'true'],
        'description' => $body,
        'pubDate' => $event->created
    ]);
}

?>