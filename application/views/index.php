        <!--<div class="row">
            <div id="welcome" class="row hide-on-small-only">
                <div class="col s3 offset-s9">
                    <div class="card-panel teal">
                      <span class="white-text">
                        欢迎来到泉州五中点歌台！
                      </span>
                    </div>
                </div>
            </div>
        </div>-->

		<div class="container">

		    <div id="songs">
		        <!--
		        	Song list added by JavaScript
		        -->
		    </div>
	    	<!-- Loading -->
		    <div id="loading-icon" class="spinner">
			  <div class="bounce1"></div>
			  <div class="bounce2"></div>
			  <div class="bounce3"></div>
			</div>
		    <!-- 不会写分页！！！！瀑布流搞吧！！！！-->

			<!--<ul class="pagination">
				<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
				<li class="active"><a href="#!">1</a></li>
				<li class="waves-effect"><a href="#!">2</a></li>
				<li class="waves-effect"><a href="#!">3</a></li>
				<li class="waves-effect"><a href="#!">4</a></li>
				<li class="waves-effect"><a href="#!">5</a></li>
				<li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
			</ul>-->

	    </div>

	    <!--add botton-->
		<div id="add-btn" class="fixed-action-btn">
			<a class="btn-floating btn-large red">
			  <i class="large material-icons">mode_edit</i>
			</a>
			<!--<ul>
			  <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
			  <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
			  <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
			  <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
			</ul>-->
		</div>
		<!--add botton end-->

		<!-- Add Song Modal -->
		<div id="add-modal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <h4>我要点歌</h4>
                <div class="row">
					<button type="button" id="song-search-btn" songid="">搜索歌曲</button>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="username-inputbox" type="text" class="validate">
                        <label for="text">点歌人</label>
                    </div>
                </div>
            </div>
		    <div class="modal-footer">
                  <a class=" modal-action modal-close waves-effect waves-green btn-flat">取消</a>
                  <a id="song-add-submit-btn" class=" modal-action waves-effect waves-light btn">提交<i class="material-icons right">send</i></a>
		    </div>
		  </div>

		<!-- Search Song Modal -->
		<div id="search-modal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <h4>搜索</h4>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="song-search-name" type="text" class="validate">
                        <label for="text">歌曲名</label>
                    </div>
                </div>
                <div class="row">
                	<div id="song-search-result">
						<!-- Song list added by JavaScript -->
					</div>
                </div>
                <p id="search-loading-p" style="display:none;text-align: center;">Loading ...</p>
                <button id="search-loadmore-btn" class="btn">加载更多</button>
            </div>
		    <div class="modal-footer">
                  <a class=" modal-action modal-close waves-effect waves-green btn-flat">取消</a>
                  <a id="song-search-submit-btn" class="modal-action waves-effect waves-light btn">搜索</a>
		    </div>
		  </div>
