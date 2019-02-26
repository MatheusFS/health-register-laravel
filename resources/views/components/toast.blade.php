<?php if(!isset($title)){$title = $slot;} ?>
<div class='toast shadow' role='alert' aria-live='assertive' aria-atomic='true' data-autohide='false' style='z-index:9999;position:absolute;top:5px;width:400px;left:calc(50% - 200px)'>
    <div class='border-0 toast-header bg-{{$type}} text-white'>
        <strong class='mr-auto mt-1' style='letter-spacing: 0.8px;'>{{$title}}</strong><small>11 mins ago</small>
        <button type='button' class='ml-2 mt-1 close' data-dismiss='toast' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    </div>
    @if($title != $slot)
    <div class='toast-body'>{{$slot}}</div>
    @endif
</div>

<script type="text/javascript">
    $(".toast").fadeIn();
    $(".toast").toast("show");
    setTimeout(()=>{$(".toast").fadeOut(600,()=>{$(".toast").remove();});},2000);
</script>