@if(Session::has('message') || Session::has('error'))
    <?php
    if(Session::has('message'))  {
        $message = Session::get('message');
        $message = array("type" => "success", "message" => $message);
    }
    if(Session::has('error')){
        $message = Session::get('error');
        $message = array("type" => "error", "message" => $message);
    }
    $types = array(
            "success" => "success",
            "error" => "danger"
    );
    $type = $types[$message['type']];

    Session::forget('message');
    Session::forget('error');
    ?>
    <div class="alert alert-<?=$type?>">
        <strong><?=ucfirst($message['type']).'!'?></strong> <?=$message['message']?>
    </div>
@endif