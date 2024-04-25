<div style="display: flex;align-items:center;">
    <a href="#" onclick="backComment();return false;">
        <i class="bx bxs-chevron-left" style="font-size: 25px;"></i>
    </a>
    <h5 style="flex: 1;">

        Total Replies: {{ $reply->count() }}
    </h5>
</div>

<br>
<div class="row">
    <div class="col-sm-1">
        <img src="/assets/images/plantifeedpics/rounded.png" alt="Image Description" class="object-cover rounded-full" style="width: 30px; height: 30px;">
    </div>
    <div class="col-sm-11 bg-light p-2" style="margin-left: -15px;">
        <p style="font-size: 12px;">
            <strong>
                {{ $comment->firstname }}{{ $comment->lastname }}
            </strong><br>
            <span style="color: grey;font-size: 12px;">{{ date('F j, Y h:i:s A', strtotime($comment->created_at)) }}</span>
        </p>
        <p style="font-size: 12px;">
            {{ $comment->content }}
        </p>
        <a href="#">Like</a>
    </div>
</div>
<br>
<div id="reply-section" style="margin-left: 30px;">

    @foreach ($reply as $per_reply)
    <div class="row">
        <div class="col-sm-1">
            <img src="/assets/images/plantifeedpics/rounded.png" alt="Image Description" class="object-cover rounded-full" style="width: 25px; height: 25px;">
        </div>
        <div class="col-sm-11 bg-light p-2" style="margin-left: -15px;">
            <p style="font-size: 11px;">
                <strong>
                    {{ $per_reply->firstname }}{{ $per_reply->lastname }}
                </strong><br>
                <span style="color: grey;font-size: 11px;">{{ date('F j, Y h:i:s A', strtotime($per_reply->created_at)) }}</span>
            </p>
            <p style="font-size: 11px;">
                {{ $per_reply->reply_content }}
            </p>
            <a href="#">Like</a>
        </div>
    </div>
    <br>
    @endforeach
</div>