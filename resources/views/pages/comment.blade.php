<div class="row">
    <div class="col-sm-1">
        <img src="/assets/images/plantifeedpics/rounded.png" alt="Image Description" class="object-cover rounded-full" style="width: 40px; height: 40px; margin-right: 8px;">
    </div>
    <div class="col-sm-10">
        <p>
            <strong>
                {{ $post->firstname }}{{ $post->lastname }}
            </strong><br>
            <span style="color: grey;">{{ date('F j, Y h:i:s A', strtotime($post->created_at)) }}</span>
        </p>
        <p>
            {{ $post->question }}
        </p>
    </div>
</div>

<hr>
<div id="comment-section">
    @foreach ($comment as $per_comment)
    <div class="row">
        <div class="col-sm-1">
            <img src="/assets/images/plantifeedpics/rounded.png" alt="Image Description" class="object-cover rounded-full" style="width: 30px; height: 30px;">
        </div>
        <div class="col-sm-11 bg-light p-2" style="margin-left: -15px;">
            <p style="font-size: 12px;">
                <strong>
                    {{ $per_comment->firstname }}{{ $per_comment->lastname }}
                </strong><br>
                <span style="color: grey;font-size: 12px;">{{ date('F j, Y h:i:s A', strtotime($per_comment->created_at)) }}</span>
            </p>
            <p style="font-size: 12px;">
                {{ $per_comment->content }}
            </p>
            <a href="#">Like</a> <a href="#" onclick="getReply()">Reply</a>
        </div>
    </div>
    <br>
    @endforeach
</div>