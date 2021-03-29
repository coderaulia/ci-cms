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
		} else if (hash == "ambil") {
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
});

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
