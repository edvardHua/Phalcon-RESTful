define({ "api": [
  {
    "type": "get",
    "url": "admin/user",
    "title": "获得全部用户信息",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "defaultValue": "api-version=1.0",
            "description": "<p>api版本</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Accept\": \"api-version=1.0\"\n  \"token\": xxx\n}",
          "type": "String"
        }
      ]
    },
    "name": "getUser",
    "group": "Admin",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "users",
            "description": "<p>该用户的信息 HTTP/1.1 200 OK { &quot;users&quot;: [ { &quot;id&quot;: &quot;1&quot;, &quot;username&quot;: &quot;Admin&quot;, &quot;name&quot;: &quot;Edvard&quot;, &quot;organization&quot;: null, &quot;title&quot;: &quot;Software Enginner&quot;, &quot;email&quot;: &quot;edvard_hua@live.com&quot; }, { &quot;id&quot;: &quot;2&quot;, &quot;username&quot;: &quot;MCAA2015&quot;, &quot;name&quot;: &quot;Lucky&quot;, &quot;organization&quot;: &quot;WTF&quot;, &quot;title&quot;: null, &quot;email&quot;: null } ], &quot;total_pages&quot;: 1, &quot;total_items&quot;: 2, &quot;current&quot;: 1, &quot;prev&quot;: &quot;/admin/user?p=1&quot;, &quot;next&quot;: &quot;/admin/user?p=2&quot;, &quot;perpage&quot;: 10 }</p>"
          }
        ]
      }
    },
    "filename": "../v1.0/controllers/AdminController.php",
    "groupTitle": "Admin",
    "sampleRequest": [
      {
        "url": "http://example/admin/user"
      }
    ],
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ParamInvalid",
            "description": "<p>参数不合法或为空</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Required-Response:",
          "content": "HTTP/1.1 406 Not Acceptable\n{\n \"errors\": [\n             {\n               \"type\": \"PresenceOf\",\n               \"field\": \"param_key\",\n               \"message\": \"The param_key is required\"\n             }\n           ]\n}",
          "type": "json"
        },
        {
          "title": "Error-Invalid-Response:",
          "content": "HTTP/1.1 406 Not Acceptable\n{\n \"errors\": [\n             {\n               \"type\": \"Inclusion\",\n               \"field\": \"param_key\",\n               \"message\": \"The param_key is not valid\"\n             }\n           ]\n}",
          "type": "json"
        },
        {
          "title": "Error-Invalid-Token-Response:",
          "content": "HTTP/1.1 401  Unauthorized\n{\n \"errors\": [\n             {\n                \"type\": \"Inclusion\",\n                \"field\": \"token\",\n                \"message\": \"Permission denied.\"\n             }\n           ]\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "admin/user/{id}",
    "title": "获得指定用户信息",
    "name": "getUser",
    "group": "Admin",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "user",
            "description": "<p>该用户的信息 HTTP/1.1 200 OK { &quot;users&quot;: [ { &quot;id&quot;: &quot;1&quot;, &quot;username&quot;: &quot;Admin&quot;, &quot;name&quot;: &quot;Edvard&quot;, &quot;organization&quot;: null, &quot;title&quot;: &quot;Software Enginner&quot;, &quot;email&quot;: &quot;edvard_hua@live.com&quot; }, { &quot;id&quot;: &quot;2&quot;, &quot;username&quot;: &quot;MCAA2015&quot;, &quot;name&quot;: &quot;Lucky&quot;, &quot;organization&quot;: &quot;WTF&quot;, &quot;title&quot;: null, &quot;email&quot;: null } ], &quot;total_pages&quot;: 1, &quot;total_items&quot;: 2, &quot;current&quot;: 1, &quot;prev&quot;: &quot;/admin/user?p=1&quot;, &quot;next&quot;: &quot;/admin/user?p=2&quot;, &quot;perpage&quot;: 10 }</p>"
          }
        ]
      }
    },
    "filename": "../v1.0/controllers/AdminController.php",
    "groupTitle": "Admin",
    "sampleRequest": [
      {
        "url": "http://example/admin/user/{id}"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "defaultValue": "api-version=1.0",
            "description": "<p>api版本</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "token",
            "defaultValue": "xxx",
            "description": "<p>授权的token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Accept\": \"api-version=1.0\"\n  \"token\": xxx\n}",
          "type": "String"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ParamInvalid",
            "description": "<p>参数不合法或为空</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Required-Response:",
          "content": "HTTP/1.1 406 Not Acceptable\n{\n \"errors\": [\n             {\n               \"type\": \"PresenceOf\",\n               \"field\": \"param_key\",\n               \"message\": \"The param_key is required\"\n             }\n           ]\n}",
          "type": "json"
        },
        {
          "title": "Error-Invalid-Response:",
          "content": "HTTP/1.1 406 Not Acceptable\n{\n \"errors\": [\n             {\n               \"type\": \"Inclusion\",\n               \"field\": \"param_key\",\n               \"message\": \"The param_key is not valid\"\n             }\n           ]\n}",
          "type": "json"
        },
        {
          "title": "Error-Invalid-Token-Response:",
          "content": "HTTP/1.1 401  Unauthorized\n{\n \"errors\": [\n             {\n                \"type\": \"Inclusion\",\n                \"field\": \"token\",\n                \"message\": \"Permission denied.\"\n             }\n           ]\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/token",
    "title": "登录获得token",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "defaultValue": "api-version=1.0",
            "description": "<p>api版本</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Accept\": \"api-version=1.0\"\n}",
          "type": "String"
        }
      ]
    },
    "name": "login",
    "group": "Token",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>用户名</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>该用户的token，两小时后失效</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"token\": \"xxx\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../v1.0/controllers/PublicController.php",
    "groupTitle": "Token",
    "sampleRequest": [
      {
        "url": "http://example//token"
      }
    ],
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ParamInvalid",
            "description": "<p>参数不合法或为空</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Required-Response:",
          "content": "HTTP/1.1 406 Not Acceptable\n{\n \"errors\": [\n             {\n               \"type\": \"PresenceOf\",\n               \"field\": \"param_key\",\n               \"message\": \"The param_key is required\"\n             }\n           ]\n}",
          "type": "json"
        },
        {
          "title": "Error-Invalid-Response:",
          "content": "HTTP/1.1 406 Not Acceptable\n{\n \"errors\": [\n             {\n               \"type\": \"Inclusion\",\n               \"field\": \"param_key\",\n               \"message\": \"The param_key is not valid\"\n             }\n           ]\n}",
          "type": "json"
        },
        {
          "title": "Error-Invalid-Token-Response:",
          "content": "HTTP/1.1 401  Unauthorized\n{\n \"errors\": [\n             {\n                \"type\": \"Inclusion\",\n                \"field\": \"token\",\n                \"message\": \"Permission denied.\"\n             }\n           ]\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/token",
    "title": "登录获得token",
    "name": "logout",
    "group": "Token",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "empty_array",
            "description": "<p>空数组，无实际意义</p>"
          }
        ]
      }
    },
    "filename": "../v1.0/controllers/PublicController.php",
    "groupTitle": "Token",
    "sampleRequest": [
      {
        "url": "http://example//token"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "defaultValue": "api-version=1.0",
            "description": "<p>api版本</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "token",
            "defaultValue": "xxx",
            "description": "<p>授权的token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Accept\": \"api-version=1.0\"\n  \"token\": xxx\n}",
          "type": "String"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ParamInvalid",
            "description": "<p>参数不合法或为空</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Required-Response:",
          "content": "HTTP/1.1 406 Not Acceptable\n{\n \"errors\": [\n             {\n               \"type\": \"PresenceOf\",\n               \"field\": \"param_key\",\n               \"message\": \"The param_key is required\"\n             }\n           ]\n}",
          "type": "json"
        },
        {
          "title": "Error-Invalid-Response:",
          "content": "HTTP/1.1 406 Not Acceptable\n{\n \"errors\": [\n             {\n               \"type\": \"Inclusion\",\n               \"field\": \"param_key\",\n               \"message\": \"The param_key is not valid\"\n             }\n           ]\n}",
          "type": "json"
        },
        {
          "title": "Error-Invalid-Token-Response:",
          "content": "HTTP/1.1 401  Unauthorized\n{\n \"errors\": [\n             {\n                \"type\": \"Inclusion\",\n                \"field\": \"token\",\n                \"message\": \"Permission denied.\"\n             }\n           ]\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "delete",
    "url": "/admin/user/{id}",
    "title": "删除某个用户",
    "name": "deleteUser",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>该子会议的ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>该子会议名称 必选</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "organization",
            "description": "<p>子会议的开始时间</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "title",
            "description": "<p>子会议的结束时间</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>子会议举行场地</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>该子会议可接纳的人数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "empty_array",
            "description": "<p>空数组</p>"
          }
        ]
      }
    },
    "filename": "../v1.0/controllers/AdminController.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://example//admin/user/{id}"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "defaultValue": "api-version=1.0",
            "description": "<p>api版本</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "token",
            "defaultValue": "xxx",
            "description": "<p>授权的token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Accept\": \"api-version=1.0\"\n  \"token\": xxx\n}",
          "type": "String"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/user",
    "title": "获得当前登录用户信息",
    "name": "getUser",
    "group": "User",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "user",
            "description": "<p>该用户的信息 HTTP/1.1 200 OK { &quot;user&quot;: { &quot;username&quot;: &quot;Admin&quot;, &quot;name&quot;: &quot;Edvard&quot;, &quot;organization&quot;: null, &quot;title&quot;: &quot;Software Enginner&quot;, &quot;email&quot;: &quot;edvard_hua@live.com&quot; } }</p>"
          }
        ]
      }
    },
    "filename": "../v1.0/controllers/UserController.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://example//user"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "defaultValue": "api-version=1.0",
            "description": "<p>api版本</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "token",
            "defaultValue": "xxx",
            "description": "<p>授权的token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Accept\": \"api-version=1.0\"\n  \"token\": xxx\n}",
          "type": "String"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ParamInvalid",
            "description": "<p>参数不合法或为空</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Required-Response:",
          "content": "HTTP/1.1 406 Not Acceptable\n{\n \"errors\": [\n             {\n               \"type\": \"PresenceOf\",\n               \"field\": \"param_key\",\n               \"message\": \"The param_key is required\"\n             }\n           ]\n}",
          "type": "json"
        },
        {
          "title": "Error-Invalid-Response:",
          "content": "HTTP/1.1 406 Not Acceptable\n{\n \"errors\": [\n             {\n               \"type\": \"Inclusion\",\n               \"field\": \"param_key\",\n               \"message\": \"The param_key is not valid\"\n             }\n           ]\n}",
          "type": "json"
        },
        {
          "title": "Error-Invalid-Token-Response:",
          "content": "HTTP/1.1 401  Unauthorized\n{\n \"errors\": [\n             {\n                \"type\": \"Inclusion\",\n                \"field\": \"token\",\n                \"message\": \"Permission denied.\"\n             }\n           ]\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/user",
    "title": "注册接口",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "defaultValue": "api-version=1.0",
            "description": "<p>api版本</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Accept\": \"api-version=1.0\"\n}",
          "type": "String"
        }
      ]
    },
    "name": "register",
    "group": "User",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "empty_array",
            "description": "<p>空数组</p>"
          }
        ]
      }
    },
    "filename": "../v1.0/controllers/PublicController.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://example//user"
      }
    ],
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ParamInvalid",
            "description": "<p>参数不合法或为空</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Required-Response:",
          "content": "HTTP/1.1 406 Not Acceptable\n{\n \"errors\": [\n             {\n               \"type\": \"PresenceOf\",\n               \"field\": \"param_key\",\n               \"message\": \"The param_key is required\"\n             }\n           ]\n}",
          "type": "json"
        },
        {
          "title": "Error-Invalid-Response:",
          "content": "HTTP/1.1 406 Not Acceptable\n{\n \"errors\": [\n             {\n               \"type\": \"Inclusion\",\n               \"field\": \"param_key\",\n               \"message\": \"The param_key is not valid\"\n             }\n           ]\n}",
          "type": "json"
        },
        {
          "title": "Error-Invalid-Token-Response:",
          "content": "HTTP/1.1 401  Unauthorized\n{\n \"errors\": [\n             {\n                \"type\": \"Inclusion\",\n                \"field\": \"token\",\n                \"message\": \"Permission denied.\"\n             }\n           ]\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "put",
    "url": "/user",
    "title": "更新当前登录用户信息",
    "name": "updateUser",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>该子会议的ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>该子会议名称 必选</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "organization",
            "description": "<p>子会议的开始时间</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "title",
            "description": "<p>子会议的结束时间</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>子会议举行场地</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>该子会议可接纳的人数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "empty_array",
            "description": "<p>空数组</p>"
          }
        ]
      }
    },
    "filename": "../v1.0/controllers/UserController.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://example//user"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "defaultValue": "api-version=1.0",
            "description": "<p>api版本</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "token",
            "defaultValue": "xxx",
            "description": "<p>授权的token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Accept\": \"api-version=1.0\"\n  \"token\": xxx\n}",
          "type": "String"
        }
      ]
    }
  }
] });
