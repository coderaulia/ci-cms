var editor = "";
var path = window.location.pathname;
// memanggil host name
var host = window.location.hostname;

$(function () {
	$(window).hashchange(function () {
		// memanggil hash yg punya value berbeda
		var hash = $.param.fragment();

		if (hash == "tambah") {
			if (path.search("admin/artikel/kategori") > 0) {
				var kategori_artikel = getJSON("http://" + host + path + "/ambil", {});

				/* kategori artikel */
				$("#category_parent option").remove();
				$("#category_parent").append(
					'<option value="">Pilih Induk Kategori</option>'
				);
				if (kategori_artikel.record) {
					$.each(kategori_artikel.record, function (key, value) {
						$("#category_parent").append(
							'<option value="' +
								value["category_ID"] +
								'">' +
								value["category_name"] +
								"</option>"
						);
					});
				}

				$("#myModal .modal-header #myModalLabel").text(
					"Tambah Kategori Artikel"
				);
				$("#myModal .modal-footer #submit-kategori-artikel").text("Tambah!");
				$("#myModal #form-kategori-artikel").attr("action", "tambah");
			} else if (path.search("admin/artikel") > 0) {
				removeeditor();
				//memanggil ckeditor
				createeditor();
				//memanggil kategori
				var kategori_artikel = getJSON(
					"http://" + host + path + "/kategori/ambil",
					{}
				);
				var htmlStr = "";
				var printTree = function (node) {
					htmlStr =
						htmlStr + '<ul class="list-group check-list-group-kategori">';

					for (var i = 0; i < node.length; i++) {
						htmlStr =
							htmlStr +
							'<li class="list-group-item"><label class="checkbox inline"><input type="checkbox" name="category_slug[]" value="' +
							node[i]["category_slug"] +
							'"> ' +
							node[i]["category_name"] +
							"</label></li>";

						if (node[i]["children"]) {
							printTree(node[i]["children"]);
						}

						htmlStr = htmlStr + "</li>";
					}

					htmlStr = htmlStr + "</ul>";
					return htmlStr;
				};

				// mensortir array menjadi parent children hierarki
				tree = unflatten(kategori_artikel.record);
				$(".tab-pane#kategori fieldset div.control-group").html(
					printTree(tree)
				);

				// Memanggil hari ini, untuk input waktu
				var today = moment();
				$("#myModal .modal-body #date").val(today.format("D"));
				$(
					'#myModal .modal-body #month option[value ="' +
						today.format("M") +
						'"]'
				).prop("selected", true);
				$("#myModal .modal-body #year").val(today.format("YYYY"));
				$("#myModal .modal-body #hour").val(today.format("HH"));
				$("#myModal .modal-body #minute").val(today.format("mm"));

				// Mengambil get data di tbl user
				var penulis = getJSON(
					"http://" +
						host +
						path.replace("admin/artikel", "admin/user") +
						"/action/ambil/ID,username",
					{}
				);
				$("#post_author option").remove();

				for (var i in penulis.record) {
					$("#post_author").append(
						'<option value="' +
							penulis.record[i]["ID"] +
							'">' +
							penulis.record[i]["username"] +
							"</option>"
					);
				}

				// Mengatur inner html di modal tambah artikel
				$("#myModal .modal-header #myModalLabel").text("Tambah Artikel");
				$("#myModal .modal-footer #submit-artikel").text("Posting!");
				$("#myModal #form-artikel").attr("action", "tambah");
			} else if (path.search("admin/halaman") > 0) {
				var halaman = getJSON("http://" + host + path + "/action/ambil", {});
				$("#post_parent option").remove();
				$("#post_parent").append(
					'<option value="">Pilih Induk Halaman</option>'
				);
				if (halaman.record) {
					$.each(halaman.record, function (key, value) {
						$("#post_parent").append(
							'<option value="' +
								value["post_ID"] +
								'">' +
								value["post_title"] +
								"</option>"
						);
					});
				}

				removeeditor();
				createeditor();

				$("#myModal .modal-header #myModalLabel").text("Tambah Halaman");
				$("#myModal .modal-footer #submit-halaman").text("Tambah!");
				$("#myModal #form-halaman").attr("action", "tambah");
			}
			// memunculkan pop-up
			$("#myModal").addClass("big-modal");
			$("#myModal").modal("show");
		} else if (hash.search("edit") == 0) {
			if (path.search("admin/artikel/kategori") > 0) {
				var kategori_artikel = getJSON("http://" + host + path + "/ambil", {});
				$("#category_parent option").remove();
				$("#category_parent").append(
					'<option value="">Pilih Induk Kategori</option>'
				);
				if (kategori_artikel.record) {
					$.each(kategori_artikel.record, function (key, value) {
						$("#category_parent").append(
							'<option value="' +
								value["category_ID"] +
								'">' +
								value["category_name"] +
								"</option>"
						);
					});
				}

				/* get value kategori */
				var cat_ID = getUrlVars()["id"];
				var kategori_detail = getJSON("http://" + host + path + "/ambil", {
					id: cat_ID,
				});
				$("#myModal .modal-body #category_name").val(
					kategori_detail.data["category_name"]
				);
				$("#myModal .modal-body #category_description").val(
					kategori_detail.data["category_description"]
				);
				$(
					'#myModal .modal-body #category_parent option[value ="' +
						kategori_detail.data["category_parent"] +
						'"]'
				).prop("selected", true);

				/* all atribut initialized */
				$("#myModal .modal-body #category_id").val(cat_ID);

				$("#myModal .modal-header #myModalLabel").text("Edit Artikel");
				$("#myModal .modal-footer #submit-kategori-artikel").text("Update!");
				$("#myModal #form-kategori-artikel").attr("action", "update");
			} else if (path.search("admin/artikel") > 0) {
				let post_ID = getUrlVars()["id"];

				//melemparkan ID ke artikel controller
				let artikel_detail = getJSON(
					"http://" + host + path + "/action/ambil",
					{ id: post_ID }
				);
				// mengisi data ke form edit
				$("#myModal .modal-body #post_title").val(
					artikel_detail.data["post_title"]
				);
				removeeditor();
				createeditor(artikel_detail.data["post_content"]);
				// $("#myModal .modal-body #post_content").val(
				// 	artikel_detail.data["post_content"]
				// );

				// untuk memanggil kategori
				var kategori_artikel = getJSON(
					"http://" + host + path + "/kategori/ambil",
					{}
				);
				var post_category = artikel_detail.data["post_category"].split(",");
				var tree = unflatten(kategori_artikel.record);
				var htmlStr = "";
				var printTree = function (node) {
					htmlStr =
						htmlStr + '<ul class="list-group check-list-group-kategori">';

					for (var i = 0; i < node.length; i++) {
						htmlStr =
							htmlStr +
							'<li class="list-group-item"><label class="checkbox inline"><input type="checkbox" name="category_slug[]" value="' +
							node[i]["category_slug"] +
							'"> ' +
							node[i]["category_name"] +
							"</label></li>";

						if (node[i]["children"]) {
							printTree(node[i]["children"]);
						}

						htmlStr = htmlStr + "</li>";
					}

					htmlStr = htmlStr + "</ul>";
					return htmlStr;
				};

				$(".tab-pane#kategori fieldset div.control-group").html(
					printTree(tree)
				);

				for (var i in post_category) {
					// alert(post_category[i]);
					$(
						"ul.check-list-group-kategori li.list-group-item input[type=checkbox][value=" +
							post_category[i] +
							"]"
					).prop("checked", true);
				}

				// memanggil waktu posting artikel
				var postdate = moment(artikel_detail.data["post_date"]);
				$("#myModal .modal-body #date").val(postdate.format("D"));
				$(
					'#myModal .modal-body #month option[value ="' +
						postdate.format("M") +
						'"]'
				).prop("selected", true);
				$("#myModal .modal-body #year").val(postdate.format("YYYY"));
				$("#myModal .modal-body #hour").val(postdate.format("HH"));
				$("#myModal .modal-body #minute").val(postdate.format("mm"));

				// Mengatur komentar di artikel
				if (artikel_detail.data["comment_status"] != "") {
					$("#comment_status").prop("checked", true);
				}

				// notif dan seo
				if (artikel_detail.data["post_attribute"]) {
					$.each(artikel_detail.data["post_attribute"], function (key, value) {
						if (value != "")
							$("#" + key)
								.attr("value", value)
								.prop("checked", true);
					});
				}

				// Memanggil penulis artikel
				var penulis = getJSON(
					"http://" +
						host +
						path.replace("admin/artikel", "admin/user") +
						"/action/ambil/ID,username",
					{}
				);
				$("#post_author option").remove();

				for (var i in penulis.record) {
					$("#post_author").append(
						'<option value="' +
							penulis.record[i]["ID"] +
							'">' +
							penulis.record[i]["username"] +
							"</option>"
					);
				}

				$(
					'#post_author option[value ="' +
						artikel_detail.data["post_author"] +
						'"]'
				).prop("selected", true);

				$("#myModal .modal-header #myModalLabel").text("Edit Artikel");
				$("#myModal .modal-footer #submit-artikel").text("Update!");
				$("#myModal #form-artikel").attr("action", "update");
				//hidden post id input
				$("#myModal #form-artikel #post_id").val(post_ID);
			} else if (path.search("admin/halaman") > 0) {
				var post_ID = getUrlVars()["id"];
				var halaman_detail = getJSON(
					"http://" + host + path + "/action/ambil",
					{ id: post_ID }
				);

				// alert();

				var halaman = getJSON("http://" + host + path + "/action/ambil", {});
				$("#post_parent option").remove();
				$("#post_parent").append(
					'<option value="">Pilih Induk Halaman</option>'
				);
				if (halaman.record) {
					$.each(halaman.record, function (key, value) {
						// if(value['post_ID' == halaman_detail.data['post_ID']]){}
						$("#post_parent").append(
							'<option value="' +
								value["post_ID"] +
								'">' +
								value["post_title"] +
								"</option>"
						);
					});
				}

				$(
					'#myModal .modal-body #post_parent option[value ="' +
						halaman_detail.data["post_parent"] +
						'"]'
				).prop("selected", true);

				removeeditor();
				createeditor(halaman_detail.data["post_content"]);
				$("#myModal .modal-body #post_title").val(
					halaman_detail.data["post_title"]
				);

				/* atribut komentar + atribut seo */
				if (halaman_detail.data["comment_status"] != "") {
					$("#comment_status").prop("checked", true);
				}

				$.each(halaman_detail.data["post_attribute"], function (key, value) {
					if (value != "")
						$("#" + key)
							.attr("value", value)
							.prop("checked", true);
				});

				$("#myModal .modal-header #myModalLabel").text("Edit Halaman");
				$("#myModal .modal-footer #submit-halaman").text("Update!");
				$("#myModal #form-halaman").attr("action", "update");
				$("#myModal #form-halaman #post_id").val(post_ID);

				// Management komentar
			} else if (path.search("admin/komentar") > 0) {
				var comment_ID = getUrlVars()["id"];
				var comment_detail = getJSON(
					"http://" + host + path + "/action/ambil",
					{ id: comment_ID }
				);

				$("#myModal .modal-body #comment_author_name").val(
					comment_detail.data["comment_author_name"]
				);
				$("#myModal .modal-body #comment_author_email").val(
					comment_detail.data["comment_author_email"]
				);
				$("#myModal .modal-body #comment_author_url").val(
					comment_detail.data["comment_author_url"]
				);
				$("#myModal .modal-body #comment_content").val(
					comment_detail.data["comment_content"]
				);
				$(
					'#myModal .modal-body #comment_approved option[value ="' +
						comment_detail.data["comment_approved"] +
						'"]'
				).prop("selected", true);
				$("#myModal .modal-header #myModalLabel").text("Edit Komentar");
				$("#myModal .modal-footer #submit-komentar").text("Update!");
				$("#myModal #form-komentar").attr("action", "update");
				$("#myModal #form-komentar #comment_ID").val(
					comment_detail.data["comment_ID"]
				);
			}
			// memunculkan pop-up
			$("#myModal").addClass("big-modal");
			$("#myModal").modal("show");
		} else if (hash.search("hapus") == 0) {
			if (path.search("admin/artikel/kategori") > 0) {
				var category_ID = getUrlVars()["id"];
				var kategori_detail = getJSON("http://" + host + path + "/ambil", {
					id: category_ID,
				});
				$("#myModal form").hide();
				$("#myModal #form-kategori-artikel").attr("action", "hapus");
				$("#myModal .modal-header #myModalLabel").text(
					"Hapus Kategori Artikel"
				);
				$("#myModal .modal-footer #submit-kategori-artikel").text(
					"Ya Hapus Saja!"
				);
				$("#myModal .modal-body").prepend(
					'<p id="hapus-notif">Apakah Anda yakin akan menghapus : <b>"' +
						kategori_detail.data["category_name"] +
						'"</b> ???</p>'
				);
				$("#myModal #form-kategori-artikel #category_id").val(category_ID);
			} else if (path.search("admin/artikel") > 0) {
				let post_ID = getUrlVars()["id"];
				//melemparkan ID ke artikel controller
				let artikel_detail = getJSON(
					"http://" + host + path + "/action/ambil",
					{ id: post_ID }
				);
				$("#myModal form").hide();
				$("#myModal .modal-header #myModalLabel").text("Hapus Artikel");
				$("#myModal .modal-footer #submit-artikel").text("Hapus!");
				$("#myModal #form-artikel").attr("action", "hapus");
				$("#myModal .modal-body").prepend(
					'<p id="hapus-notif">Apakah Anda yakin akan menghapus artikel berjudul: <b>' +
						artikel_detail.data["post_title"] +
						" ?</b></p>"
				);
				$("#myModal #form-artikel #post_id").val(post_ID);
			} else if (path.search("admin/halaman") > 0) {
				var post_ID = getUrlVars()["id"];
				var halaman_detail = getJSON(
					"http://" + host + path + "/action/ambil",
					{ id: post_ID }
				);

				$("#myModal form").hide();
				$("#myModal .modal-header #myModalLabel").text("Hapus Halaman");
				$("#myModal .modal-footer #submit-halaman").text("Ya Hapus Saja!");
				$("#myModal #form-halaman").attr("action", "hapus");
				$("#myModal .modal-body").prepend(
					'<p id="hapus-notif">Apakah Anda yakin akan menghapus : <b>"' +
						halaman_detail.data["post_title"] +
						'"</b> ???</p>'
				);
				$("#myModal #form-halaman #post_id").val(post_ID);
			} else if (path.search("admin/komentar") > 0) {
				var comment_ID = getUrlVars()["id"];
				var komentar_detail = getJSON(
					"http://" + host + path + "/action/ambil",
					{ id: comment_ID }
				);

				$("#myModal form").hide();
				$("#myModal .modal-header #myModalLabel").text("Hapus Komentar");
				$("#myModal .modal-footer #submit-komentar").text("Ya Hapus Saja!");
				$("#myModal #form-komentar").attr("action", "hapus");
				$("#myModal .modal-body").prepend(
					'<p id="hapus-notif">Apakah Anda yakin akan menghapus komentar dari : <b>"' +
						komentar_detail.data["comment_author_name"] +
						'"</b> ???</p>'
				);
				$("#myModal #form-komentar #comment_ID").val(comment_ID);
			}

			$("#myModal").modal("show");
		} else if (hash.search("ambil") == 0) {
			if (path.search("admin/artikel") > 0) {
				var hal_aktif,
					cari,
					kategori = null;
				var hash = getUrlVars();

				if (hash["hal"]) {
					hal_aktif = hash["hal"];
				}

				ambil_artikel(hal_aktif, true);
				$("ul#pagination-artikel li a:contains('" + hal_aktif + "')")
					.parents()
					.addClass("active")
					.siblings()
					.removeClass("active");

				// ambil komentar
			} else if (path.search("admin/komentar") > 0) {
				var hal_aktif,
					cari = null;
				var hash = getUrlVars();
				if (hash["cari"] && hash["hal"]) {
					hal_aktif = hash["hal"];
					cari = hash["cari"];
				} else if (hash["hal"]) {
					hal_aktif = hash["hal"];
				}

				ambil_komentar(hal_aktif, true, cari);
				$("ul#pagination-komentar li a:contains('" + hal_aktif + "')")
					.parents()
					.addClass("active")
					.siblings()
					.removeClass("active");
			}
		} else if (hash.search("mass") == 0) {
			if (path.search("admin/artikel")) {
				var action = getUrlVars()["action"];
				var numberOfChecked = $("#tbl-artikel input:checkbox:checked").length;
				if (numberOfChecked > 0) {
					if (action == "hapus") {
						var note = "menghapus";
					} else if (action == "publish") {
						var note = "mempublish";
					} else if (action == "pending") {
						var note = "mempending";
					}

					$("#myModal #form-artikel").attr("action", "mass");
					$("#myModal #form-artikel #mass_action_type").val(action);
					$("#myModal .modal-header #myModalLabel").text("Aksi Artikel masal");
					$("#myModal .modal-footer #submit-artikel")
						.text("Ya Langsung Saja!")
						.show();
					$("#myModal .modal-body").prepend(
						'<p id="hapus-notif">Apakah Anda yakin akan ' +
							note +
							" <b>artikel-artikel terpilih</b>?</p>"
					);
				} else {
					$("#myModal .modal-header #myModalLabel").text("Peringatan!!");
					$("#myModal .modal-footer #submit-artikel").hide();
					$("#myModal #form-artikel").attr("action", "bulk");
					$("#myModal .modal-body").prepend(
						'<p id="hapus-notif">Mohon maaf, aksi artikel tidak bisa dilakukan karena tidak ada satupun artikel yang di ceklis. Silahkan ceklis satu atau beberapa ...</p>'
					);
				}
				$("#myModal form").hide();
			}

			// mass action komentar
			else if (path.search("admin/komentar") > 0) {
				var action = getUrlVars()["action"];
				var numberOfChecked = $("#tbl-komentar input:checkbox:checked").length;
				if (numberOfChecked > 0) {
					if (action == "hapus") {
						var note = "menghapus";
					} else if (action == "publish") {
						var note = "mempublish";
					} else if (action == "pending") {
						var note = "mempending";
					}

					$("#myModal #form-komentar").attr("action", "mass");
					$("#myModal #form-komentar #mass_action_type").val(action);
					$("#myModal .modal-header #myModalLabel").text("Aksi Artikel masal");
					$("#myModal .modal-footer #submit-komentar")
						.text("Ya Langsung Saja!")
						.show();
					$("#myModal .modal-body").prepend(
						'<p id="hapus-notif">Apakah Anda yakin akan ' +
							note +
							' : <b>"komentar-komentar terpilih"</b> ???</p>'
					);
				} else {
					$("#myModal .modal-header #myModalLabel").text("Peringatan!!");
					$("#myModal .modal-footer #submit-komentar").hide();
					$("#myModal #form-komentar").attr("action", "bulk");
					$("#myModal .modal-body").prepend(
						'<p id="hapus-notif">Mohon maaf, aksi komentar tidak bisa dilakukan karena tidak ada satupun komentar yang di ceklis. Silahkan ceklis satu atau beberapa ...</p>'
					);
				}
				$("#myModal form").hide();
			}

			$("#myModal").modal("show");
		}

		if (path.search("admin/tampilan") > 0) {
			$("#myModal").addClass("big-modal");

			// pengaturan template
			if (hash.search("setting") == 0) {
				var template_detail = getJSON(
					"http://" + host + path + "/action/ambil",
					{ option_name: "template_setting" }
				);

				$(
					"#myModal .modal-body #form-tampilan fieldset.form-horizontal div.control-group"
				).empty();

				$.each(
					template_detail.template_setting["template_attribute"],
					function (index, element) {
						if (
							template_detail.template_setting["template_attribute"][index]
								.type == "text"
						) {
							$(
								"#myModal .modal-body #form-tampilan fieldset.form-horizontal div.control-group"
							).append(
								'<label class="control-label">' +
									humanize(index) +
									"</label>" +
									'<div class="controls">' +
									'<input type="text" name="' +
									index +
									'" id="' +
									index +
									'" class="form-control input-block-level" value="' +
									template_detail.template_setting["template_attribute"][index]
										.value +
									'" /> ' +
									"</div>"
							);
						}
					}
				);

				$(
					"#myModal .modal-body #form-tampilan fieldset.form-horizontal"
				).show();
				$("#myModal .modal-body div.template_detail").remove();
				$("#myModal .modal-body #form-tampilan").attr("action", "update");
				$("#myModal .modal-header #myModalLabel").text("Setting Tampilan");
				$("#myModal .modal-footer #submit-tampilan").text("Simpan!");
				$("#myModal").modal("show");

				// mengaktifkan template
			} else if (hash.search("aktifkan") == 0) {
				var template = getUrlVars()["template"];
				var template_detail = getJSON(
					"http://" + host + path + "/action/ambil",
					{ template: template }
				);

				$("#myModal .modal-body div.template_detail").remove();
				$("#myModal .modal-body").append(
					'<div class="template_detail">' +
						'<div class="span4">' +
						'<img src="http://' +
						host +
						path.replace("admin/tampilan", "templates/frontend/") +
						template_detail["data"].template_directory +
						'/screenshot.png" />' +
						"</div>" +
						'<div class="span5">' +
						"<h2>Template " +
						template_detail["data"].template_name +
						" " +
						template_detail["data"].template_version +
						"</h2>" +
						"<p>Dibuat oleh: <strong>" +
						template_detail["data"].template_author +
						"</strong></p>" +
						template_detail["data"].template_description +
						"</div>" +
						"</div>"
				);

				$("#myModal .modal-body #form-tampilan").attr("action", "update");
				$("#myModal .modal-body #form-tampilan #template_directory").val(
					template
				);
				$(
					"#myModal .modal-body #form-tampilan fieldset.form-horizontal"
				).hide();
				$("#myModal .modal-header #myModalLabel").text(
					"Aktifkan Template " + humanize(template)
				);
				$("#myModal .modal-footer #submit-tampilan").text(
					"Aktifkan Template Ini!"
				);
				$("#myModal").modal("show");
			}
		}
	});

	$(window).trigger("hashchange");

	// kondisi jika myModal sedang tidak dibuka, maka akan mereset form
	$("#myModal").on("hidden", function () {
		window.history.pushState(null, null, path);
		$("#myModal").removeClass("big-modal");
		$("#myModal #hapus-notif").remove();
		$("#myModal form")
			.find(
				"input[type=text], input[type=hidden], input[type=password], input[type=email], textarea"
			)
			.val("")
			.attr("placeholder", "");
		$("#myModal form")
			.find("input[type=checkbox],input[type=radio]")
			.removeAttr("checked");
		$("#myModal form").find("select").prop("selected", false);
		$("#myModal form p.warning").remove();
		$("#myModal form").show();
	});

	//check all btn
	$("#btn-check-all").toggle(
		function () {
			$("table input:checkbox").attr("checked", "checked");
		},
		function () {
			$("table input:checkbox").removeAttr("checked");
		}
	);

	// pop-up modal
	$("#myModal").on("hidden", function () {
		window.history.pushState(null, null, path);
		$("#myModal").removeClass("big-modal");
		$("#myModal #hapus-notif").remove();
		//clear form
		$("#myModal form").find("input[type=text], textarea").val("");
		$("#myModal form").show();
	});

	moment.locale("id");

	// Ajax Data CRUD for admin

	$(document).on("click", "#submit-artikel", function (eve) {
		eve.preventDefault();

		var action = $("#form-artikel").attr("action");
		// memilih tipe mass action
		var mass_action_type = $("#form-artikel #mass_action_type").val();

		// jika ada hash mass, maka akan pakai mass action
		if (action == "mass") {
			var dataSend =
				$("#tbl-artikel input").serialize() +
				"&mass_action_type=" +
				mass_action_type;
		} else {
			var dataSend =
				$("#form-artikel").serialize() + "&post_content=" + editor.getData();
		}

		$.ajax("http://" + host + path + "/action/" + action, {
			dataType: "json",
			type: "POST",
			data: dataSend,
			success: function (data) {
				if (data.status == "success") {
					$("#myModal").modal("hide");
					ambil_artikel(null, false);
					//menambahkan alert jika berhasil
					$("div.widget-content").prepend(
						'<div class="control-group"><div class="alert alert-info">' +
							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
							"<strong>Berhasil!</strong> Artikel berhasil diubah! </div></div>"
					);
				} else {
					//mengeluarkan error data dengan perulangan (karena berbentuk array)
					$.each(data.errors, function (key, value) {
						$("#" + key).attr("placeholder", value);
					});
				}
			},
		});
	});

	if (getUrlVars()["hal"]) {
		ambil_artikel(getUrlVars()["hal"], false);
	} else {
		ambil_artikel(null, false);
	}

	// Untuk Kategori
	$(document).on("click", "#submit-kategori-artikel", function (eve) {
		eve.preventDefault();
		var action = $("#form-kategori-artikel").attr("action");

		$.ajax("http://" + host + path + "/" + action, {
			dataType: "json",
			type: "POST",
			data: $("#form-kategori-artikel").serialize(),
			success: function (data) {
				if (data.status == "success") {
					ambil_kategori();
					$("#myModal").modal("hide");
				} else {
					$.each(data.errors, function (key, value) {
						$("#" + key).attr("placeholder", value);
					});
				}
			},
		});
	});

	ambil_kategori();

	// untuk drag n drop kategori
	$("#list-kategori .list-group").sortable({
		opacity: 0.5,
		cursor: "move",
		placeholder: "ui-state-highlight",
	});

	$(document).on("click", "#submit-halaman", function (eve) {
		eve.preventDefault();
		var action = $("#form-halaman").attr("action");

		if (action == "hapus") {
			var datatosend = $("#form-halaman").serialize();
		} else {
			var datatosend =
				$("#form-halaman").serialize() + "&post_content=" + editor.getData();
		}

		$.ajax("http://" + host + path + "/action/" + action, {
			dataType: "json",
			type: "POST",
			data: datatosend,
			success: function (data) {
				if (data.status == "success") {
					ambil_halaman();
					$("#form-halaman").find("input[type=text], textarea").val("");
					$("#myModal").modal("hide");
					$("div.widget-content").prepend(
						'<div class="control-group"><div class="alert alert-info">' +
							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
							"<strong>Berhasil!</strong> Halaman Telah Diperbaharui ...</div></div>"
					);
				} else {
					$.each(data.errors, function (key, value) {
						$("#" + key).attr("placeholder", value);
					});
				}
			},
		});
	});

	ambil_halaman();

	// komentar

	ambil_komentar();

	$(document).on("click", "#submit-komentar", function (eve) {
		eve.preventDefault();
		var action = $("#form-komentar").attr("action");
		var mass_action_type = $("#form-komentar #mass_action_type").val();

		if (action == "mass") {
			var datatosend =
				$("#tbl-komentar input").serialize() +
				"&mass_action_type=" +
				mass_action_type;
		} else {
			var datatosend = $("#form-komentar").serialize();
		}

		$.ajax("http://" + host + path + "/action/" + action, {
			dataType: "json",
			type: "POST",
			data: datatosend,
			success: function (data) {
				if (data.status == "success") {
					ambil_komentar();
					$("#form-komentar").find("input[type=text], textarea").val("");
					$("#myModal").modal("hide");
					$("div.widget-content").prepend(
						'<div class="control-group"><div class="alert alert-info">' +
							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
							"<strong>Berhasil!</strong> Komentar Telah Diperbaharui ...</div></div>"
					);
				}
			},
		});
	});

	// Tampilan
	ambil_tampilan();

	$(document).on("click", "#submit-tampilan", function (eve) {
		var action = $("#form-tampilan").attr("action");

		$.ajax("http://" + host + path + "/action/" + action, {
			dataType: "json",
			type: "POST",
			data: $("#form-tampilan").serialize(),
			success: function (data) {
				if (data.status == "success") {
					ambil_tampilan();
					$("#form-tampilan")
						.find("input[type=text], input[type=hidden]")
						.val("");
					$("#myModal").modal("hide");
				}
			},
		});
	});

	// prevent using enter to submit
	$(document).on("submit", "#myModal form", function (eve) {
		eve.preventDefault();
	});
});

// Various FUNCTION

function ambil_artikel(hal_aktif, scrolltop) {
	if ($("table#tbl-artikel").length > 0) {
		$.ajax("http://" + host + path + "/action/ambil", {
			dataType: "json",
			type: "POST",
			data: { hal_aktif: hal_aktif },
			success: function (data) {
				$("table#tbl-artikel tbody tr").remove();
				//perulangan mengambil data record artikel
				$.each(data.record, function (index, element) {
					var post_status = "";
					if (element.post_status == "pending") {
						post_status = "(pending)";
					}
					$("table#tbl-artikel")
						.find("tbody")
						.append(
							"<tr>" +
								'  <td width="2%"><input type="checkbox" name="post_id[]" value="' +
								element.post_ID +
								'"></td>' +
								'  <td width="50%"><a class="link-edit" href="artikel#edit?id=' +
								element.post_ID +
								'">' +
								element.post_title +
								"</a><strong>" +
								post_status +
								"</strong> <strong></strong></td>" +
								'  <td width="10%"><i class="icon-comment-alt"></i> <span class="value">' +
								element.comment_count +
								"</span></td>" +
								'  <td width="10%"><i class="icon-eye-open"></i> <span class="value">' +
								element.post_counter +
								"</span></td>" +
								'  <td width="12%"><i class="icon-time"></i> <span class="value">' +
								moment(element.post_date).fromNow() +
								"</span></td>" +
								'  <td width="16%" class="td-actions">' +
								'    <a href="artikel#edit?id=' +
								element.post_ID +
								'" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a>' +
								'    <a href="artikel#hapus?id=' +
								element.post_ID +
								'" class="btn btn-invert btn-small btn-info"><i class="btn-icon-only icon-remove" id="hapus_1"></i> Hapus</a>' +
								"  </td>" +
								"</tr>"
						);
				});

				var pagination = "";
				//menghitung baris per halaman
				var paging = Math.ceil(data.total_rows / data.perpage);

				if (!hal_aktif && $("ul#pagination-artikel li").length == 0) {
					$("ul#pagination-artikel li").remove();
					for (i = 1; i <= paging; i++) {
						pagination =
							pagination +
							'<li><a href="artikel#ambil?hal=' +
							i +
							'">' +
							i +
							"</a></li>";
					}
				} else if (hal_aktif) {
					$("ul#pagination-artikel li").remove();
					for (i = 1; i <= paging; i++) {
						pagination =
							pagination +
							'<li><a href="artikel#ambil?&hal=' +
							i +
							'">' +
							i +
							"</a></li>";
					}
				}

				$("ul#pagination-artikel").append(pagination);
				$("ul#pagination-artikel li:contains('" + hal_aktif + "')").addClass(
					"active"
				);

				if (scrolltop == true) {
					$("body").scrollTop(0);
				}
			},
		});
	}
}

// Fungsi untuk mengambil kategori

function ambil_kategori() {
	// jsfiddle.net/LkkwH/1/
	// http://jsfiddle.net/sw_lasse/9wpHa/
	var path = window.location.pathname;
	var host = window.location.hostname;
	if ($("#list-kategori").length > 0) {
		$.ajax("http://" + host + path + "/ambil", {
			dataType: "json",
			type: "POST",
			success: function (data) {
				$("#list-kategori ul").remove();
				/*
        // BAGIAN 1 
        var htmlStr = '<ul class="list-group hirarki kategori">';
        
        $.each(data.record, function(index, element) {
            htmlStr = htmlStr + '<li id="ID_'+element.category_ID+'" class="list-group-item">';          
            htmlStr = htmlStr + '<a class="link-edit" href="kategori#edit?id='+element.category_ID+'">'+element.category_name+'</a>';
            htmlStr = htmlStr + '<div class="pull-right">';
            htmlStr = htmlStr + '<a href="kategori#edit?id='+element.category_ID+'" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> ';
            htmlStr = htmlStr + '<a href="kategori#hapus?id='+element.category_ID+'" id="hapus_" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a>';
            htmlStr = htmlStr + '</div>' ;                  
            htmlStr = htmlStr + '</li>'; 
        });

        htmlStr = htmlStr + "</ul>";
        
        $('#list-kategori').html(htmlStr); 
         */

				var htmlStr = "";
				var printTree = function (node) {
					htmlStr = htmlStr + '<ul class="list-group hirarki kategori">';

					for (var i = 0; i < node.length; i++) {
						if (node[i]["children"]) var listyle = "li-parent";
						else listyle = "";
						htmlStr =
							htmlStr +
							'<li id="ID_' +
							node[i]["category_ID"] +
							'" class="list-group-item ' +
							listyle +
							'">';
						htmlStr =
							htmlStr +
							'<a class="link-edit" href="kategori#edit?id=' +
							node[i]["category_ID"] +
							'">' +
							node[i]["category_name"] +
							"</a>";
						htmlStr = htmlStr + '<div class="pull-right">';
						htmlStr =
							htmlStr +
							'<a href="kategori#edit?id=' +
							node[i]["category_ID"] +
							'" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> ';
						htmlStr =
							htmlStr +
							'<a href="kategori#hapus?id=' +
							node[i]["category_ID"] +
							'" id="hapus_" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a>';
						htmlStr = htmlStr + "</div>";

						if (node[i]["children"]) {
							printTree(node[i]["children"]);
						}

						htmlStr = htmlStr + "</li>";
					}

					htmlStr = htmlStr + "</ul>";
					return htmlStr;
				};

				tree = unflatten(data.record);

				$("#list-kategori").html(printTree(tree));

				// sortir hierarki kategori
				$("#list-kategori .list-group").sortable({
					opacity: 0.5,
					cursor: "move",
					placeholder: "ui-state-highlight",
					update: function () {
						var orderAll = [];
						$(".list-group li").each(function () {
							orderAll.push($(this).attr("id").replace(/_/g, "[]="));
						});

						// alert($(this).sortable('serialize'));
						$.post("http://" + host + path + "/sortir", orderAll.join("&"));
					},
				});
			},
		});
	}
}

// Mengatur hirarki kategori parent & child
function unflatten(array, parent, tree) {
	tree = typeof tree !== "undefined" ? tree : [];
	parent = typeof parent !== "undefined" ? parent : { category_ID: 0 };

	var children = _.filter(array, function (child) {
		return child.category_parent == parent.category_ID;
	});

	if (!_.isEmpty(children)) {
		if (parent.category_ID == 0) {
			tree = children;
		} else {
			parent["children"] = children;
		}
		_.each(children, function (child) {
			unflatten(array, child);
		});
	}

	return tree;
}

function humanize(str) {
	str = str.replace(/-/g, " ");
	str = str.replace(/_/g, " ");
	return str.charAt(0).toUpperCase() + str.slice(1);
}

function ambil_halaman() {
	// jsfiddle.net/LkkwH/1/
	// http://jsfiddle.net/sw_lasse/9wpHa/
	var path = window.location.pathname;
	var host = window.location.hostname;
	if ($("#list-halaman").length > 0) {
		$.ajax("http://" + host + path + "/action/ambil", {
			dataType: "json",
			type: "POST",
			success: function (data) {
				var htmlStr = "";
				var printTree = function (node) {
					htmlStr = htmlStr + '<ul class="list-group hirarki halaman">';

					for (var i = 0; i < node.length; i++) {
						if (node[i]["children"]) var listyle = "li-parent";
						else listyle = "";

						htmlStr =
							htmlStr +
							'<li id="ID_' +
							node[i]["post_ID"] +
							'" class="list-group-item ' +
							listyle +
							'">';
						htmlStr =
							htmlStr +
							'<a class="link-edit" href="halaman#edit?id=' +
							node[i]["post_ID"] +
							'">' +
							node[i]["post_title"] +
							"</a>";
						htmlStr = htmlStr + '<div class="pull-right">';
						htmlStr =
							htmlStr +
							'<a href="halaman#edit?id=' +
							node[i]["post_ID"] +
							'" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> ';
						htmlStr =
							htmlStr +
							'<a href="halaman#hapus?id=' +
							node[i]["post_ID"] +
							'" id="hapus_" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a>';
						htmlStr = htmlStr + "</div>";

						if (node[i]["children"]) {
							printTree(node[i]["children"]);
						}

						htmlStr = htmlStr + "</li>";
					}

					htmlStr = htmlStr + "</ul>";
					return htmlStr;
				};

				tree = unflattenHalaman(data.record);
				$("#list-halaman").html(printTree(tree));

				$("#list-halaman .list-group").sortable({
					opacity: 0.5,
					cursor: "move",
					placeholder: "ui-state-highlight",
					update: function () {
						var orderAll = [];
						$(".list-group li").each(function () {
							orderAll.push($(this).attr("id").replace(/_/g, "[]="));
						});

						// alert($(this).sortable('serialize'));
						$.post(
							"http://" + host + path + "/action/sortir",
							orderAll.join("&")
						);
					},
				});
			},
		});
	}
}

function unflattenHalaman(array, parent, tree) {
	tree = typeof tree !== "undefined" ? tree : [];
	parent = typeof parent !== "undefined" ? parent : { post_ID: 0 };

	var children = _.filter(array, function (child) {
		return child.post_parent == parent.post_ID;
	});

	if (!_.isEmpty(children)) {
		if (parent.post_ID == 0) {
			tree = children;
		} else {
			parent["children"] = children;
		}
		_.each(children, function (child) {
			unflattenHalaman(array, child);
		});
	}

	return tree;
}

// mengambil json

function getJSON(url, data) {
	return JSON.parse(
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			dataType: "json",
			global: false,
			async: false,
			success: function (msg) {},
		}).responseText
	);
}

// menampilkan hasil angka dari hash
function getUrlVars() {
	var vars = [],
		hash;
	var hashes = window.location.href
		.slice(window.location.href.indexOf("?") + 1)
		.split("&");
	for (var i = 0; i < hashes.length; i++) {
		hash = hashes[i].split("=");
		vars.push(hash[0]);
		vars[hash[0]] = hash[1];
	}
	return vars;
}

// memanggil CKEditor
function createeditor(content) {
	if (editor) return;
	editor = CKEDITOR.appendTo(
		"wrap_editor",
		{
			bodyId: "post_content",
			bodyName: "post_content",
			name: "post_content",
			entities: false,
			uiColor: "#fafafa",
			height: "800px",
			toolbar: [
				"/",
				{
					name: "document",
					groups: ["mode", "document", "doctools"],
					items: ["Source"],
				},
				{ name: "tools", items: ["Maximize"] },
				{
					name: "basicstyles",
					groups: ["basicstyles", "cleanup"],
					items: ["Bold", "Italic", "Strike", "-"],
				},
				{
					name: "paragraph",
					groups: ["list", "indent", "blocks", "align"],
					items: [
						"NumberedList",
						"BulletedList",
						"-",
						"Outdent",
						"Indent",
						"-",
						"Blockquote",
					],
				},
				{
					name: "clipboard",
					groups: ["clipboard", "undo"],
					items: ["Undo", "Redo"],
				},
				{ name: "links", items: ["Link", "Unlink", "Anchor"] },
				{
					name: "insert",
					items: ["Image", "Table", "HorizontalRule", "SpecialChar"],
				},
				{ name: "styles", items: ["Styles", "Format"] },
			],
		},
		content
	);
}

// Menghapus jika tidak digunakan
function removeeditor() {
	if (!editor) return;

	// Destroy the editor.
	editor.destroy();
	editor = null;
}

// Mengambil tampilan
function ambil_tampilan() {
	var path = window.location.pathname;
	var host = window.location.hostname;
	if ($("#list-tampilan").length > 0) {
		$.ajax("http://" + host + path + "/action/ambil", {
			dataType: "json",
			type: "POST",
			success: function (data) {
				$("#list-tampilan div.single-tampilan").remove();
				$(
					"#myModal .modal-body #form-tampilan fieldset.form-horizontal div.control-group"
				).empty();
				$.each(data.record, function (index, element) {
					// alert(element.template_name);
					$("#list-tampilan").append(
						'<div class="span3 single-tampilan">' +
							'  <img src="http://' +
							host +
							path.replace("admin/tampilan", "templates/frontend/") +
							element.template_directory +
							'/screenshot.png" />' +
							'  <a href="#aktifkan?template=' +
							element.template_directory +
							'" class="pull-right">Aktifkan!</a><h4 class="pull-left">' +
							element.template_name +
							" v." +
							element.template_version +
							"</h4>" +
							"</div>"
					);
				});

				/* ini untuk bagian detail template edit */
				$("#template-now img").attr(
					"src",
					"http://" +
						host +
						path.replace("admin/tampilan", "templates/frontend/") +
						data["template_setting"].template_directory +
						"/screenshot.png"
				);

				$("body").scrollTop(0);
			},
		});
	}
}

function ambil_komentar(hal_aktif, scrolltop, cari) {
	var path = window.location.pathname;
	var host = window.location.hostname;
	if ($("table#tbl-komentar").length > 0) {
		$.ajax("http://" + host + path + "/action/ambil", {
			dataType: "json",
			type: "POST",
			data: { hal_aktif: hal_aktif, cari: cari },
			success: function (data) {
				/***********************/
				/* tampilkan datanya  */
				/**********************/
				$("table#tbl-komentar tbody tr").remove();
				$.each(data.record, function (index, element) {
					var status = "";
					if (element.comment_approved == "pending")
						status = " <strong>(pending)</strong>";

					$("table#tbl-komentar")
						.find("tbody")
						.append(
							"<tr>" +
								'    <td width="2%"><input type="checkbox" name="comment_ID[]" value="' +
								element.comment_ID +
								'"></td>' +
								'    <td width="20%">' +
								"      <span><strong>" +
								element.comment_author_name +
								"</strong></span>" +
								"      <span>" +
								'         <a href="' +
								element.comment_author_url +
								'">' +
								element.comment_author_url +
								"</a><br />" +
								'         <a href="mailto:' +
								element.comment_author_email +
								'">' +
								element.comment_author_email +
								"</a><br />" +
								'         <a href="#">' +
								element.comment_author_IP +
								"</a>" +
								"      </span>" +
								"    </td>" +
								'    <td width="30%">' +
								element.comment_content +
								status +
								"</td>" +
								'    <td width="20%"><i class="icon-file"></i> <span>' +
								humanize(element.post_type) +
								' : "<a href="' +
								element.post_type +
								"#edit?id=" +
								element.post_ID +
								'">' +
								element.post_title +
								'</a>"</span></td>' +
								'    <td width="12%"><i class="icon-time"></i> <span class="value">' +
								moment(element.comment_date).fromNow() +
								"</span></td>" +
								'    <td width="16%" class="td-actions">' +
								'      <a href="komentar#edit?id=' +
								element.comment_ID +
								'" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> ' +
								'      <a href="komentar#hapus?id=' +
								element.comment_ID +
								'" id="hapus_' +
								element.comment_ID +
								'" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a>' +
								"    </td>" +
								"</tr>"
						);
				});

				/********************/
				/*  buat pagination */
				/********************/
				var pagination = "";
				var paging = Math.ceil(data.total_rows / data.perpage);

				if (!hal_aktif && $("ul#pagination-komentar li").length == 0) {
					$("ul#pagination-komentar li").remove();
					for (i = 1; i <= paging; i++) {
						pagination =
							pagination +
							'<li><a href="komentar#ambil?hal=' +
							i +
							'">' +
							i +
							"</a></li>";
					}
				} else if (hal_aktif && cari) {
					$("ul#pagination-komentar li").remove();
					for (i = 1; i <= paging; i++) {
						pagination =
							pagination +
							'<li><a href="komentar#ambil?cari=' +
							cari +
							"&hal=" +
							i +
							'">' +
							i +
							"</a></li>";
					}
				}

				$("ul#pagination-komentar").append(pagination);
				$("ul#pagination-komentar li:contains('" + hal_aktif + "')").addClass(
					"active"
				);

				if (scrolltop == true) {
					$("body").scrollTop(0);
				}
			},
		});
	}
}

var lineChartData = {
	labels: ["23", "25", "25", "26", "27"],
	datasets: [
		{
			fillColor: "rgba(151,187,205,0.5)",
			strokeColor: "rgba(151,187,205,1)",
			pointColor: "rgba(151,187,205,1)",
			pointStrokeColor: "#fff",
			data: [2700, 2700, 2900, 2600, 2900],
		},
	],
};

var myLine = new Chart(
	document.getElementById("area-chart").getContext("2d")
).Line(lineChartData);
