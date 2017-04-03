var json,num,tittle,id,prev_tittle,played_id,played_tittle,playing;

function finish_play() {
    alert('已到达设定时间或没有歌曲可播了');
    $('#player-set-time-btn').html('确定');
    playing = false;
    $('.player-info').hide();
    $('#player-prev-song-btn').hide();
    $('#player-next-song-btn').hide();
}
function add_song(num) {
    $.getJSON('/admin/view/1/' + num + '/0/ASC', function(json){
        id=json.music_item[0].id;
        musicid=json.music_item[0].musicid;
        tittle=json.music_item[0].tittle;
        artist=json.music_item[0].artist;
        songurl = 'https://api.lwl12.com/music/netease/song?id=' + musicid;
        picurl = 'https://api.lwl12.com/music/netease/pic?id=' + musicid;
        lyricurl = 'https://api.lwl12.com/music/netease/lyric?id=' + musicid + '&raw=true';
        ap = new APlayer({
            element: document.getElementById('player'),
            narrow: false,
            autoplay: true,
            showlrc: 3,
            mutex: true,
            preload: 'auto',
            mode: 'order',
            music: {
                title: tittle,
                author: artist,
                url: songurl,
                pic: picurl,
                lrc: lyricurl
            }
        });
        ap.on('ended', function() {
            //歌曲播放完成后
            $.post("admin/update_status", { id: id, status: '1' }, function(json) {
                $.post("admin/putout", { id:id }, function(json){
                    console.log(json.status);
                    if (json.status == '1') {
                        Materialize.toast('《' + tittle + '》播出成功！', 4000);
                        console.log('num++:'+num);
                        num++;
                        play(num);
                    } else {
                        Materialize.toast('播出失败！', 4000);
                    }
                }, 'json');
            }, 'json');
        });
    });
    $.getJSON('/admin/view/1/' + (num+1) + '/0/ASC', function(json){
        //获取下一首歌曲信息
        total = json.music_item.length;
        if (total === 0) {
            finish_play()
        } else {
            next_tittle=json.music_item[0].tittle;
            $('#next-song-name').html(next_tittle);
        }
    });
    if (num>1) {
        $.getJSON('/admin/view/1/' + (num-1) + '/0/ASC', function(json){
            //获取上一首歌曲信息
            prev_tittle=json.music_item[0].tittle;
            $('#prev-song-name').html(prev_tittle);
        });
    } else {
        $('#prev-song-name').html('这是第一首歌呀');
    }
}
function play(num) {
    var myDate = new Date();
    current_time = myDate.getTime();
    if (current_time >= stop_time && playing) {
        finish_play();
    } else {
        add_song(num);
        playing = true;
        $('#player-set-time-btn').html('加时');
    }
}

$('#player-set-time-btn').click(function() {
    play_minutes = parseInt($('#last-time').val());
    console.log(play_minutes);
    if (!play_minutes>0) {
        alert('请输入正确的播放时间！')
    } else {
        var myDate = new Date();
        current_time = myDate.getTime();
        stop_time = new Date(current_time + play_minutes*60*1000);
        $('#stop-time').html(stop_time);
        $('.player-info').show();
        $('#player-prev-song-btn').show();
        $('#player-next-song-btn').show();
        if (!playing) {
            num = 0;
            play(0);
        }
    }
});
$('#player-next-song-btn').click(function() {
    num++;
    play(num);
});
$('#player-prev-song-btn').click(function() {
    num--;
    play(num);
});