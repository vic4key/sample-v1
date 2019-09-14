jQuery(document).ready(function ($)
{
	$("#mn_about").click(function()
	{
		var about_header  = $(this).text();
		var about_content = $("#footer * span").text();
		$("#md_about > .modal-dialog > .modal-content > .modal-header > .modal-title").text(about_header);
		$("#md_about > .modal-dialog > .modal-content > .modal-body").html(about_content);
	});
});

$(window).on("load", function()
{
	footer();
});

$(window).on("resize", function()
{
	footer();
});

$(window).on("scroll", function()
{
	footer();
});

function footer()
{
	if ($(window).scrollTop() + $(window).height() == $(document).height())
	{
		$("#footer").show();
	}
	else
	{
		$("#footer").hide();
	}
}