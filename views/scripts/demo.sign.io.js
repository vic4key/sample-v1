jQuery(document).ready(function($)
{
	const eType =
	{
		DEFAULT: 0,
		SUCCESS: 1,
		FAILURE: 2,
	};

	function fnMessage(element, type, message)
	{
		var addClass = "alert-default";

		if (type == eType.FAILURE)
		{
			addClass = "alert-danger";
		}
		else if (type == eType.SUCCESS)
		{
			addClass = "alert-success";
		}

		$(element)
		.removeClass("alert-default")
		.removeClass("alert-success")
		.removeClass("alert-danger")
		.addClass(addClass)
		.show()
		.find("p").text(message);
	};

	function fnTabHandler(tabid, hidealert = false)
	{
		if (hidealert)
		{
			fnMessage(tabid, eType.DEFAULT, "");
			$(tabid).find(".alert").hide();
		}

		var response = $.ajax(
		{
			url: BASE_URL + "/api/users/me",
			type: "GET",
			async: false,
		});

		var signedin = response.status == 200 && response.responseJSON.hasOwnProperty("name");

		switch (tabid)
		{
			case "#tab_signin":
				{
					$("#frm_signin")
					.find("input")
					.attr("disabled", signedin);

					$("#frm_signin")
					.find("button[type=submit]")
					.attr("disabled", signedin)
					.text(signedin ? "Signed In as [" + response.responseJSON.name + "]" : "Sign In");
				}
				break;

			case "#tab_signout":
				{
					$("#frm_signout")
					.find("button[type=submit]")
					.attr("disabled", !signedin)
					.text("Sign Out" + (!signedin ? "" : " [" + response.responseJSON.name + "]"));
				}
				break;

			default:
				break;
		}
	}

	/**
	 * Dialog and Tabs
	 */

	$("#md_signio").on("show.bs.modal", function(e)
	{
		fnTabHandler($("#md_signio * li.active a").attr("href"), true);
	})
	.find("a[data-toggle=\"tab\"]").on("shown.bs.tab", function(e)
	{
		fnTabHandler($(e.target).attr("href"), true);
	});

	/**
	 * Sign In
	 */

	$("#frm_signin").bootstrapValidator(
	{
		feedbackIcons:
		{
			valid: "glyphicon glyphicon-ok",
			invalid: "glyphicon glyphicon-remove",
			validating: "glyphicon glyphicon-refresh",
		}
	})
	.on("success.form.bv", function(e)
	{
		e.preventDefault();
		$.ajax(
		{
			url: BASE_URL + "/users/signin",
			type: "POST",
			dataType: "json",
			data: {
				"name": $(this).find("input[name=user_name]").val(),
				"pass": $(this).find("input[name=user_pass]").val(),
			}
		})
		.done(function(data, textStatus, jqXHR)
		{
			fnMessage("#msg_signin", data.hasOwnProperty("user") ? eType.SUCCESS : eType.FAILURE, data.message);
			fnTabHandler($("#md_signio * li.active a").attr("href"));
		})
		.fail(function(jqXHR, textStatus, errorThrown)
		{
			fnMessage("#msg_signin", eType.FAILURE, "Sign-in failed '" + jqXHR.statusText + "'");
		});
	});

	/**
	 * Sign Out
	 */

	$("#frm_signout").submit(function(e)
	{
		e.preventDefault();
		$.ajax(
		{
			url: BASE_URL + "/users/signout",
			type: "DELETE",
		})
		.done(function(data, textStatus, jqXHR)
		{
			fnMessage("#msg_signout", eType.SUCCESS, data.message);
			fnTabHandler($("#md_signio * li.active a").attr("href"));
		})
		.fail(function(jqXHR, textStatus, errorThrown)
		{
			fnMessage("#msg_signout", eType.FAILURE, "Sign-out failed '" + jqXHR.statusText + "'");
		});
	});
});