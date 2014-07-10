<?php
include_once 'templates/site_top.php';
?>
 <!-- Para Generar Graficos -->
        <script type="text/javascript">
            jQuery(function($) {
		
                /* flot
                ------------------------------------------------------------------------- */
                var d1 = [[1293814800000, 17], [1293901200000, 29], [1293987600000, 34], [1294074000000, 46], [1294160400000, 36], [1294246800000, 16], [1294333200000, 36]];
                var d2 = [[1293814800000, 20], [1293901200000, 75], [1293987600000, 44], [1294074000000, 49], [1294160400000, 56], [1294246800000, 23], [1294333200000, 46]];
                var d3 = [[1293814800000, 32], [1293901200000, 42], [1293987600000, 59], [1294074000000, 57], [1294160400000, 47], [1294246800000, 56], [1294333200000, 59]];

                $.plot($('#pageviews'), [
                    { label: 'Unique',  data: d1},
                    { label: 'Pages',  data: d2},
                    { label: 'Hits',  data: d3}
                ], {
                    series: {
                        lines: { show: true },
                        points: { show: true }
                    },
                    xaxis: {
                        mode: 'time',
                        timeformat: '%b %d'
                    }
                });

            });
        </script>
        <section id="content">
            <section class="container_12 clearfix">
                <section id="main" class="grid_9 push_3">
                    <article id="dashboard">
                        <h1>Dashboard</h1>

                        <h2>Statistics</h2>
                        <div class="statistics">
                            <table>
                                <tr>
                                    <td>Users</td>
                                    <td><a href="#">127</a></td>
                                </tr>
                                <tr>
                                    <td>Posts</td>
                                    <td><a href="#">98</a></td>
                                </tr>
                                <tr>
                                    <td>Pages</td>
                                    <td><a href="#">11</a></td>
                                </tr>
                                <tr>
                                    <td>Categories</td>
                                    <td><a href="#">25</a></td>
                                </tr>
                                <tr>
                                    <td>Comments</td>
                                    <td><a href="#">1,231</a></td>
                                </tr>
                                <tr>
                                    <td>Messages</td>
                                    <td><a href="#">3</a></td>
                                </tr>
                                <tr>
                                    <td>Page Views</td>
                                    <td><a href="#">754</a></td>
                                </tr>
                            </table>
                        </div>
                        <div id="pageviews" style="width:420px;height:250px;"></div>
                        <div class="clear"></div>

                        <h2>Quick Links</h2>
                        <section class="icons">
                            <ul>
                                <li>
                                    <a href="#">
                                        <img src="images/eleganticons/Home.png" />
                                        <span>Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="images/eleganticons/Paper.png" />
                                        <span>Articles</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="images/eleganticons/Paper-pencil.png" />
                                        <span>Write Article</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="images/eleganticons/Speech-Bubble.png" />
                                        <span>Comments</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="images/eleganticons/Photo.png" />
                                        <span>Photos</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="images/eleganticons/Folder.png" />
                                        <span>File Manager</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="images/eleganticons/Person-group.png" />
                                        <span>User Manager</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="images/eleganticons/Config.png" />
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="images/eleganticons/Piechart.png" />
                                        <span>Statistics</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="images/eleganticons/Info.png" />
                                        <span>About</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="images/eleganticons/Mail.png" />
                                        <span>Messages</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="images/eleganticons/X.png" />
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </section>
                        

                        <h2>Recent Comments</h2>
                        <ul class="comments">
                            <li>
                                <div class="comment-body clearfix">
                                    <img class="comment-avatar" src="images/icons/dummy.gif" />
                                    <a href="#">Bruce</a> on <a href="#">Article 1</a>:
                                    <div>Whose appear moving i. Blessed. Light. A fruitful likeness every midst own yielding them greater air gathered beginning green blessed and great whose saw.</div>
                                </div>
                                <div class="links">
                                    <span class="date">02/03/2010 - 3:30</span>
                                    <a href="#" class="reply">Reply</a>
                                    <a href="#" class="delete">Delete</a>
                                </div>
                            </li>
                            <li>
                                <div class="comment-body clearfix">
                                    <img class="comment-avatar" src="images/icons/dummy.gif" />
                                    <a href="#">Steve</a> on <a href="#">Article 1</a>:
                                    <div>Fruitful divide fruitful saying can't stars make. Fly open and called there bearing you'll fruitful give. Yielding god can't great have meat isn't form which appear good creepeth first can't made dominion years winged.</div>
                                </div>
                                <div class="links">
                                    <span class="date">02/03/2010 - 3:30</span>
                                    <a href="#" class="reply">Reply</a>
                                    <a href="#" class="delete">Delete</a>
                                </div>
                            </li>
                            <li>
                                <div class="comment-body clearfix">
                                    <img class="comment-avatar" src="images/icons/dummy.gif" />
                                    <a href="#">Lauren</a> on <a href="#">Article 2</a>:
                                    <div>Seas abundantly first us morning which days darkness of midst appear. Was lesser seas fruitful third him isn't you'll given herb saw so waters given forth. Night. Deep and saying sea. The creeping spirit were.</div>
                                </div>
                                <div class="links">
                                    <span class="date">02/03/2010 - 3:30</span>
                                    <a href="#" class="reply">Reply</a>
                                    <a href="#" class="delete">Delete</a>
                                </div>
                            </li>
                            <li>
                                <div class="comment-body clearfix">
                                    <img class="comment-avatar" src="images/icons/dummy.gif" />
                                    <a href="#">Adrian</a> on <a href="#">Article 2</a>:
                                    <div>She'd living. All upon make they're you're gathered kind. Divide they're under Male make without set. Whose. Itself creeping dominion.</div>
                                </div>
                                <div class="links">
                                    <span class="date">02/03/2010 - 3:30</span>
                                    <a href="#" class="reply">Reply</a>
                                    <a href="#" class="delete">Delete</a>
                                </div>
                            </li>
                            <li>
                                <div class="comment-body clearfix">
                                    <img class="comment-avatar" src="images/icons/dummy.gif" />
                                    <a href="#">Dave</a> on <a href="#">Article 3</a>:
                                    <div>Void midst. Fill. He sixth the very saw from was gathering there replenish won't she'd creepeth fly moved lesser they're you're multiply be sea firmament. Fowl above fourth him creeping it doesn't face rule deep have winged.</div>
                                </div>
                                <div class="links">
                                    <span class="date">02/03/2010 - 3:30</span>
                                    <a href="#" class="reply">Reply</a>
                                    <a href="#" class="delete">Delete</a>
                                </div>
                            </li>
                        </ul>
                        <div class="links">
                            <a class="button" href="#">View All</a>
                        </div>
                    </article>
                    <article>
				<h1>Forms</h1>
				<h2>Form Elements</h2>
				<form id="myForm" class="uniform" method="post">
					<fieldset>
						<legend>Legend</legend>
						<dl class="inline">
							<dt><label for="name">Input Text</label></dt>
							<dd>
								<input type="text" id="name" class="medium required" size="50" />
								<small>This is an input description</small>
							</dd>

							<dt><label for="password">Input Password</label></dt>
							<dd><input type="password" id="password" class="medium required" /></dd>

							<dt><label for="select1">Select</label></dt>
							<dd>
								<select size="1" id="select1" class="medium required">
									<option value="option1">Option 1</option>
									<option value="option2">Option 2</option>
									<option value="option3">Option 3</option>
									<option value="option4">Option 4</option>
								</select>
							</dd>

							<dt><label for="select2">Multiple Select</label></dt>
							<dd>
								<select size="4" id="select2" class="medium" multiple="multiple">
									<option value="option1">Option 1</option>
									<option value="option2">Option 2</option>
									<option value="option3">Option 3</option>
									<option value="option4">Option 4</option>
								</select>
								<small>Use ctrl+click to select multiple options</small>
							</dd>
						</dl>
					</fieldset>
					<fieldset>
						<legend>Legend</legend>
						<dl class="inline">
							<dt><label>Radio</label></dt>
							<dd>
								<label><input type="radio" name="radio" value="radio1" />Radio 1</label>
								<label><input type="radio" name="radio" value="radio2" />Radio 2</label>
							</dd>

							<dt><label>Checkbox</label></dt>
							<dd>
								<label><input type="checkbox" name="cb" value="checkbox1" />Checkbox 1</label>
								<label><input type="checkbox" name="cb" value="checkbox2" />Checkbox 2</label>
								<label><input type="checkbox" name="cb" value="checkbox3" />Checkbox 3</label>
							</dd>

							<dt><label for="upload">File</label></dt>
							<dd><input type="file" id="upload" /></dd>

							<dt><label for="dob">Date</label></dt>
							<dd>
								<input type="text" name="dob" id="dob" maxlength="10" class="small" />
							</dd>

							<dt><label for="comments">Textarea</label></dt>
							<dd><textarea id="comments" class="medium"></textarea></dd>

							<dt><label for="wysiwyg">HTML Editor</label></dt>
							<dd><textarea id="wysiwyg" class="medium" rows="6"></textarea></dd>
						</dl>
						<div class="buttons">
							<button type="submit" class="button">Submit Button</button>
							<button type="button" class="button white">Cancel Button</button>
						</div>
					</fieldset>
				</form>
				<h2>Message Boxes</h2>
				
				<div class="success msg">
				This is a success message. Click to close.
				</div>
				
				<div class="error msg">
				This is an error message. Click to close.
				</div>
				
				<div class="warning msg">
				This is a warning message. Click to close.
				</div>
				
				<div class="information msg">
				This is an information message. Click to close.
				</div>
			</article>
                </section>

                <aside id="sidebar" class="grid_3 pull_9">
                    <div class="box search">
                        <form>
                            <label for="s">Search:</label>
                            <input id="s" type="text" size="20" />
                            <button class="button small">Go</button>
                        </form>
                    </div>
                    <div class="box menu">
                        <h2>Side Menu</h2>
                        <section>
                            <ul>
                                <li><a href="#">Menu Item 1</a></li>
                                <li><a href="#">Menu Item 2</a></li>
                                <li><a href="#">Menu Item 3</a></li>
                                <li><a href="#">Menu Item 4</a></li>
                                <li><a href="#">Menu Item 5</a>
                                    <ul>
                                        <li><a href="#">Menu Item 5.1</a></li>
                                        <li><a href="#">Menu Item 5.2</a>
                                            <ul>
                                                <li><a href="#">Menu Item 5.2.1</a></li>
                                                <li><a href="#">Menu Item 5.2.2</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Menu Item 5.3</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Menu Item 6</a></li>
                            </ul>
                        </section>
                    </div>
                    <div class="box info">
                        <h2>Info</h2>
                        <section>
					Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
                        </section>
                    </div>
                    <div class="box">
                        <h2>Lorem Ipsum</h2>
                        <section>
					Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
                        </section>
                    </div>
                </aside>
            </section>
        </section>

<?php
include_once 'templates/site_bottom.php';
?>
