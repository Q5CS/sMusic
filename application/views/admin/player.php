<div class="container">
    <div id="player" class="aplayer"></div>
    <div class="row">
        <div class="col s12">
            请输入播放时长：
            <div class="input-field inline">
                <input id="last-time" type="number" class="validate">
                <label for="text">分钟数</label>
            </div>
            <a id="player-set-time-btn" class="waves-effect waves-light btn">确定</a>
        </div>
    </div>
    <div class="player-action">
        <a id="player-prev-song-btn" class="left waves-effect waves-light btn"><i class="material-icons left">skip_previous</i>上一首</a>
        <a id="player-next-song-btn" class="right waves-effect waves-light btn">下一首<i class="material-icons right">skip_next</i></a>
    </div>
    <div class="player-info center-align">
        <p>上一首：<span id="prev-song-name"></span></p>
        <p>下一首：<span id="next-song-name"></span></p>
        <p>播放至：<span id="stop-time"></span></p>
        <p>
            提示：歌曲播放进度条走完后才会将状态设置为已播放；<br>
            过了设定时间以后就不会继续播放新歌曲；正在播放的歌曲不会被暂停。
        </p>
    </div>
</div>