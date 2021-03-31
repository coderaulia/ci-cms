var path = window.location.pathname;
// memanggil host name
var host = window.location.hostname;

$(function () {
	$(window).hashchange(function () {
		// memanggil hash yg punya value berbeda
		var hash = $.param.fragment();

		if (hash == "tambah") {
			if (path.search("admin/artikel") > 0) {
				// Mengatur inner html di modal tambah artikel
				$("#myModal .modal-header #myModalLabel").text("Tambah Artikel");
				$("#myModal .modal-footer #submit-artikel").text("Posting!");
				$("#myModal #form-artikel").attr("action", "tambah");
			}
			// memunculkan pop-up
			$("#myModal").addClass("big-modal");
			$("#myModal").modal("show");
		} else if (hash.search("edit") == 0) {
			if (path.search("admin/artikel") > 0) {
				$("#myModal .modal-header #myModalLabel").text("Edit Artikel");
				$("#myModal .modal-footer #submit-artikel").text("Update!");
				$("#myModal #form-artikel").attr("action", "update");
			}
			// memunculkan pop-up
			$("#myModal").addClass("big-modal");
			$("#myModal").modal("show");
		} else if (hash.search("hapus") == 0) {
			if (path.search("admin/artikel") > 0) {
				$("#myModal form").hide();
				$("#myModal .modal-header #myModalLabel").text("Hapus Artikel");
				$("#myModal .modal-footer #submit-artikel").text("Hapus!");
				$("#myModal #form-artikel").attr("action", "hapus");
				$("#myModal .modal-body").prepend(
					'<p id="hapus-notif">Apakah Anda yakin akan menghapus : Artikel?</p>'
				);
			}

			$("#myModal").modal("show");
		} else if (hash.search("ambil") == 0) {
			if (path.search("admin/artikel")) {
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
			}
		} else if (hash == "mass") {
		}
	});

	$(window).trigger("hashchange");

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
		var dataSend = $("#form-artikel").serialize();

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
							"<strong>Berhasil!</strong> Artikel telah ditambahkan! </div></div>"
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
	ambil_artikel(null, false);
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
								"</a> <strong></strong></td>" +
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
