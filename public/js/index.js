new Vue({
	el:"#app",
	data:{
		title:"Hello vue"
	},
	filters:{

	},
	mounted:exports = {
	 
	  dev: {
	    proxyTable: {
	      // proxy all requests starting with /api to jsonplaceholder
	      '/api': {
	        target: 'http://jsonplaceholder.typicode.com',
	        changeOrigin: true,
	        pathRewrite: {
	          '^/api': ''
	        }
	      }
	    }
	  }
	},
	mthods:{

	}
});