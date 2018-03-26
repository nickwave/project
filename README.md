Example project structure with MVC, autoloading and namespaces...

```
.
├── Application
│   ├── bootstrap.php
│   ├── Controllers
│   │   ├── ControllerHome.php
│   │   └── ControllerUser.php
│   ├── Core
│   │   ├── Controller.php
│   │   ├── Model.php
│   │   ├── Route.php
│   │   └── View.php
│   ├── DB
│   │   └── Adapter.php   <-- Class for database json-queries
│   ├── Models
│   │   └── ModelUser.php
│   └── Views
│       ├── homeView.php
│       ├── templateView.php
│       └── userView.php
├── .htaccess
└── index.php
```
