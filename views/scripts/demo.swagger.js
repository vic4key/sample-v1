jQuery(document).ready(function($)
{
	SwaggerUIBundle(
	{
		url: BASE_URL + "/Demo.Swagger.yaml",
		dom_id: "#swagger-ui",
	});

	var nobj = 0;

	var timer = setInterval(function()
	{
		var obj = $(".swagger-ui .loading-container");

		if (obj.length > 0)
		{
			nobj = obj.length;
		}
		else if (nobj > 0)
		{
			footer();
			clearInterval(timer);
		}
	}, 10);
});