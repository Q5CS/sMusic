function strlen(a) {
    if (typeof a != "string") {
        return 0
    }
    return a.replace(/[^\x00-\xff]/gi, "xx").length
}

$('#add-btn').click(function() {
   $('#add-modal').modal('open');
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
    post_search_songs(search_item_start,search_item_start+5);
    search_item_start += 6;
});

var ap=[];
var total;
var musicid,user,time;
var song_next = 0,song_step = 5;

function add_to_list() {
    /* Wait to add*/
}

function get_song(start,end) {
    if (end >= total) {
        end = total;
        finished = true;
        console.log('Songs have finished loading, total num is ',end);
    }
    console.log("API: admin/view/" + (end-start) + '/' + start);
    $.getJSON("admin/view/" + (end-start) + '/' + start, function(json){
        $('#loading-icon').hide();
        for (i=start;i<end;i++) {

            id=json.music_item[i-start].id;
            musicid=json.music_item[i-start].musicid;
            name=json.music_item[i-start].name;
            user=json.music_item[i-start].user;
            time=json.music_item[i-start].time;
            status=json.music_item[i-start].status;
            tittle=json.music_item[i-start].tittle;
            artist=json.music_item[i-start].artist;
            ip=json.music_item[i-start].ip;
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
                              '<div class="song-info"><p>' + name + '(' + user + ')' + '</p><p>' + time + '</p></div>'+
                            '</div>'+
                            '<div class="status ' + statusclass + '">' + statustext + '</div>'+
                            '<a class="admin-song-action-button waves-effect waves-light btn">操作</a>'+
                            '<a class="admin-song-putout-button waves-effect waves-light btn">播出</a>'+
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
        admin_action();
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
        console.log('post status:'+status);
        if(status == '1') {
            Materialize.toast('提交成功！刷新页面后即可显示', 4000);
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


/* Admin action */
function set_dropdown_action(serverid,statusdiv) {
	$('#dropdown-wait').unbind('click').click(function() {
		$('#admin-song-status').addClass('disabled');
		$('#admin-song-status').html('请稍候');
		$.post("admin/update_status", { id: serverid, status: '0' }, function(json) {
			return_status = json.status;
			console.log(return_status);
			if (return_status == '1') {
				Materialize.toast('修改成功！', 4000);
				$('#admin-song-status').removeClass('disabled');
				$('#admin-song-status').html('未播放');
				$(statusdiv).html('未播放');
				$(statusdiv).attr('class','status status-wait');
			}
		}, 'json');
	});
	$('#dropdown-played').unbind('click').click(function() {
		$('#admin-song-status').addClass('disabled');
		$('#admin-song-status').html('请稍候');
		$.post("admin/update_status", { id: serverid, status: '1' }, function(json) {
			return_status = json.status;
			if (return_status == '1') {
				Materialize.toast('修改成功！', 4000);
				$('#admin-song-status').removeClass('disabled');
				$('#admin-song-status').html('已播放');
				$(statusdiv).html('已播放');
				$(statusdiv).attr('class','status status-played');
			}
		}, 'json');
	});
	$('#dropdown-ignore').unbind('click').click(function() {
		$('#admin-song-status').addClass('disabled');
		$('#admin-song-status').html('请稍候');
		$.post("admin/update_status", { id: serverid, status: '-1' }, function(json) {
			return_status = json.status;
			if (return_status == '1') {
				Materialize.toast('修改成功！', 4000);
				$('#admin-song-status').removeClass('disabled');
				$('#admin-song-status').html('已忽略');
				$(statusdiv).html('已忽略');
				$(statusdiv).attr('class','status status-ignore');
			}
		}, 'json');
	});
}

function set_delete_action(serverid) {
	$('#admin-song-delete-button').unbind('click').click(function() {
	    $('#admin-delete-confirm-modal').modal('open');
	});
	$('#admin-confirm-delete-song-btn').unbind('click').click(function() {
		$('#admin-song-delete-button').addClass('disabled');
		$('#admin-song-delete-button').html('请稍候');
		$.post("admin/delete", { id: serverid }, function(json) {
			return_status = json.status;
			if (return_status == '1') {
				Materialize.toast('删除成功！', 4000);
				$('[serverid='+serverid+']').parents('.col').hide();
				$('#admin-song-delete-button').removeClass('disabled');
				$('#admin-song-delete-button').html('删除');
				$('#admin-song-edit-modal').modal('close');
				$('#admin-delete-confirm-modal').modal('close');
			}
		}, 'json');
	});
}

function admin_action() {
	$('.admin-song-action-button').unbind().click(function() {
		temp=$(this);
		statusdiv=$(this).prev('.status');
		temp.addClass('disabled');
		temp.html('请稍候');
	    serverid=$(this).parents('.card').children('.card-image').children('.aplayer').attr('serverid');
	    //console.log(serverid);
	    $.getJSON("admin/getone/" + serverid, function(json){
	        id=json.music_item.id;
	        musicid=json.music_item.musicid;
	        user=json.music_item.user;
	        userid=json.music_item.userid;
	        name=json.music_item.name;
	        time=json.music_item.time;
	        status=json.music_item.status;
	        tittle=json.music_item.tittle;
	        artist=json.music_item.artist;
	        ip=json.music_item.ip;
	        confirm_del_text = '您确定要删除歌曲《' + tittle + '》吗？该操作无法还原！';
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
	        $('#admin-song-name').html(tittle+' (<a href="http://music.163.com/#/song?id='+musicid+'" target="_blank">'+musicid+'</a>)');
	        $('#admin-song-user').html(name + '(' + user + ')');
	        $('#admin-song-userid').html('<a target="_blank" href="/auth/edit_user/'+userid+'">'+userid+'</a>');
	        $('#admin-song-time').html(time);
	        $('#admin-song-ip').html(ip);
	        $('#admin-song-status').html(statustext);
	        $('#admin-confirm-delete-song-text').html(confirm_del_text);
	        set_dropdown_action(serverid,statusdiv);
	        set_delete_action(serverid);

			temp.removeClass('disabled');
			temp.html('操作');
	        $('#admin-song-edit-modal').modal('open');
	    });
	});
	$('.admin-song-putout-button').unbind().click(function() {
	    serverid=$(this).parents('.card').children('.card-image').children('.aplayer').attr('serverid');
	    statusdiv=$(this).prev().prev('.status');
	    //console.log(serverid);
	    $(this).addClass('disabled');
	    $(this).html('请稍候');
	    $.post("admin/putout", { id:serverid }, function(json){
	        console.log(json.status);
	        if (json.status == '1') {
    	        id=serverid;
                ap[id].play();
    			Materialize.toast('播出成功！', 4000);
				$(statusdiv).html('已播放');
				$(statusdiv).attr('class','status status-played');
	        } else {
	            Materialize.toast('播出失败！', 4000);
	        }
	    }, 'json');
        $(this).removeClass('disabled');
		$(this).html('播出');
	});
}
/* Admin action end */


$(window).scroll(function () {
    load_more_index();
});

$.getJSON("api/get/totalnum", function(json){
    total = json.totalNum;
    song_next = song_next + song_step;
    get_song(0,song_next);
});
