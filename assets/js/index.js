function strlen(a) {
    if (typeof a != "string") {
        return 0
    }
    return a.replace(/[^\x00-\xff]/gi, "xx").length
}

$('#add-btn').click(function() {
    if (log_in) {
        $('#add-modal').modal('open');
    } else {
        Materialize.toast('请先登录！', 4000);
        $('#login-modal').modal('open');
    }
});

$('#song-search-btn').click(function() {
   $('#search-modal').modal('open');
});

var search_json;
var search_item_start = 0;
var search_name;
var ajaxing = false,finished = false;

function post_search_songs(start,end) {
    json = search_json;
    total = json.length;
    if (end >= total) {
        end = total;
        $('#search-loadmore-btn').hide();
        Materialize.toast('已经搜索完啦！', 4000);
    }
    for (i=start;i<end;i++) {
        musicid = json[i].id;
        songname=json[i].name;
        if (json[i].artist.length > 1) {
            artist = json[i].artist[0];
            for (j=1;j<=json[i].artist.length-1;j++){artist += '、' + json[i].artist[j];}
        } else {
            artist = json[i].artist[0];
        }
        $('#song-search-result').append(
'                        <ul class="collection">'+
'                           <li class="collection-item avatar" musicid="' + musicid + '">'+
'                             <img src="https://api.lwl12.com/music/netease/pic?id=' + musicid + '" alt="" class="circle">'+
'                             <span class="title">' + songname + '</span>'+
'                             <p>' + artist + '</p>'+
'                           </li>'+
'                        </ul>'
        );
    }
    search_item_click_function();
}
function search_song() {
    $('#song-search-result').html('');
    $('#search-loadmore-btn').show();
    $('#search-loading-p').show();
    search_name = $('#song-search-name').val();
    $.getJSON("https://api.lwl12.com/music/netease/search?keyword=" + search_name, function(json){
        search_json = json;
        $('#search-loading-p').hide();
        post_search_songs(0,5);
        search_item_start += 6;
    });
}

$('#song-search-submit-btn').click(function() {
    search_song();
});
$("#song-search-name").keydown(function(event){  
    if(event.which == "13")      
        search_song();
});
$('#search-loadmore-btn').click(function() {
    $('#search-loadmore-btn').show();
    search_songs(search_item_start,search_item_start+5);
    search_item_start += 6;
});

var ap=[];
var total;
var musicid,user,time;
var song_next = 0,song_step = 5;

function add_to_list() {
    $.getJSON("api/get/view/1/0", function(json){
        id=json.music_item[0].id;
        musicid=json.music_item[0].musicid;
        name=json.music_item[0].name;
        time=json.music_item[0].time;
        status=json.music_item[0].status;
        tittle=json.music_item[0].tittle;
        artist=json.music_item[0].artist;
        switch (status) {
            case '0':
                statustext = '未播放';
                statusclass = 'status-wait';
                break;
            case '1':
                statustext = '已播放';
                statusclass = 'status-played';
                break;
            case '-1':
                statustext = '已忽略';
                statusclass = 'status-ignore';
                break;
        }
        $('#songs').prepend(
            '<div class="col s12 m7">'+
                '<div class="card horizontal">'+
                  '<div class="card-image">'+
                    '<div id="player_new" class="aplayer" serverid="' + id + '" musicid="' + musicid + '"></div>'+
                  '</div>'+
                  '<div class="card-stacked">'+
                    '<div class="card-content">'+
                        '<div class="row" id="song-info-panel_new">'+
                          '<h5 class="song-name">' + tittle + '</h5><p class="song-artists">- ' + artist + '</p>'+
                          '<div class="song-info"><p>' + user + '</p><p>' + time + '</p></div>'+
                        '</div>'+
                        '<div class="status ' + statusclass + '">' + statustext + '</div>'+
                    '</div>'+
                  '</div>'+
                '</div>'+
            '</div>'
        );

        songurl = 'https://api.lwl12.com/music/netease/song?id=' + $('#player_new').attr('musicid');
        picurl = 'https://api.lwl12.com/music/netease/pic?id=' + $('#player_new').attr('musicid');
        ap_new = new APlayer({
            element: document.getElementById('player_new'),
            narrow: true,
            autoplay: false,
            mutex: true,
            preload: 'metadata',
            music: {
                url: songurl,
                pic: picurl,
            }
        });
    });
}

function get_song(start,end) {
    if (end >= total) {
        end = total;
        finished = true;
        console.log('Songs have finished loading, total num is ',end);
    }
    console.log("API: api/get/view/" + (end-start) + '/' + start);
    $.getJSON("api/get/view/" + (end-start) + '/' + start, function(json){
        $('#loading-icon').hide();
        for (i=start;i<end;i++) {

            id=json.music_item[i-start].id;
            musicid=json.music_item[i-start].musicid;
            name=json.music_item[i-start].name;
            time=json.music_item[i-start].time;
            status=json.music_item[i-start].status;
            tittle=json.music_item[i-start].tittle;
            artist=json.music_item[i-start].artist;
            switch (status) {
                case '0':
                    statustext = '未播放';
                    statusclass = 'status-wait';
                    break;
                case '1':
                    statustext = '已播放';
                    statusclass = 'status-played';
                    break;
                case '-1':
                    statustext = '已忽略';
                    statusclass = 'status-ignore';
                    break;
            }
            $('#songs').append(
                '<div class="col s12 m7">'+
                    '<div class="card horizontal">'+
                      '<div class="card-image">'+
                        '<div id="player' + i + '" class="aplayer" serverid="' + id + '" musicid="' + musicid + '"></div>'+
                      '</div>'+
                      '<div class="card-stacked">'+
                        '<div class="card-content">'+
                            '<div class="row" id="song-info-panel' + i + '">'+
                              '<h5 class="song-name">' + tittle + '</h5><p class="song-artists">- ' + artist + '</p>'+
                              '<div class="song-info"><p>' + name + '</p><p>' + time + '</p></div>'+
                            '</div>'+
                            '<div class="status ' + statusclass + '">' + statustext + '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                '</div>'
            );

            /*$.ajaxSettings.async = true;
            $.getJSON('api/GetDetail/json/'+$('#player'+i).attr('musicid')+'/'+i, function(json){
                t = json.i;
                songname=json.main.songs[0].name;
                //console.log(songname);
                if (json.main.songs[0].ar.length > 1) {
                    artist = json.main.songs[0].ar[0].name;
                    for (j=1;j<=json.main.songs[0].ar.length-1;j++){artist += '、' + json.main.songs[0].ar[j].name;}
                } else {
                    artist = json.main.songs[0].ar[0].name;
                }
                $('#song-info-panel'+t+' .song-name').html(songname);
                $('#song-info-panel'+t+' .song-artists').html('- '+artist);
            });*/
            songurl = 'https://api.lwl12.com/music/netease/song?id=' + $('#player'+i).attr('musicid');
            picurl = 'https://api.lwl12.com/music/netease/pic?id=' + $('#player'+i).attr('musicid');
            ap[id] = new APlayer({
                element: document.getElementById('player'+i),
                narrow: true,
                autoplay: false,
                mutex: true,
                preload: 'none',
                music: {
                    url: songurl,
                    pic: picurl,
                }
            });
        };
    });
    ajaxing = false;
}

function search_item_click_function () {
    $('#song-search-result ul').click(function() {
        songid = $(this).children('li').attr('musicid');
        songname = $(this).children('li').children('span').html();
        songartist = $(this).children('li').children('p').html();
        $('#song-search-btn').html(songname + ' - ' + songartist);
        $('#song-search-btn').attr('songid',songid);
        $('#search-modal').modal('close');
    });
}

function post_song(id,name) {
    $.post("api/AddMusic/add", { musicid: id, name: name }, function(json) {
        status=json.status;
        msg=json.msg;
        console.log('post status:'+status);
        if(status == 1) {
            Materialize.toast('提交成功！', 4000);
            add_to_list();
            $('#add-modal').modal('close');
        } else {
            alert(msg);
        }
        $('#song-add-submit-btn').html('提交<i class="material-icons right">send</i>');
        $('#song-add-submit-btn').removeClass('disabled');
    }, 'json');
}

$('#song-add-submit-btn').click(function() {
    id=$('#song-search-btn').attr('songid');
    user=$('#username-inputbox').val();
    if (id == '') {
        Materialize.toast('请选择歌曲！', 4000);
    } else if ($.trim(user) == '') {
        Materialize.toast('请输入姓名！', 4000);
    } else if (strlen(user) > 20) {
        Materialize.toast('用户名不能超过20个字符！', 4000);
    } else {
        $('#song-add-submit-btn').html('提交中...');
        $('#song-add-submit-btn').addClass('disabled');
        post_song(id,user);
        //需要添加动态添加歌曲的功能
    }
});

function load_more_index() {
    if ($(document).scrollTop() + $(window).height() + $('.page-footer').height() >= $(document).height()) {
        if (!finished && !ajaxing) {
            ajaxing = true;
            $('#loading-icon').show();
            get_song(song_next,song_next + song_step);
            song_next = song_next + song_step;
        }
    }
}

$(window).scroll(function () {
    load_more_index();
});

$.getJSON("api/get/totalnum", function(json){
    total = json.totalNum;
    song_next = song_next + song_step;
    get_song(0,song_next);
});
