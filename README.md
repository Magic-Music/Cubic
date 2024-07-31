# Cubic - lightweight PHP framework for CLI scripts

### The framework provides the following facilities:
- Service container for bindings and singleton declaration
- Zero-config dependency injection
- CLI command parsing including parameters, arguments and options
- CLI Logging
- Config system
- Helper functions

Much of the framework takes its inspiration from Laravel but without the weight of the full framework.

### Installation
No installation is necessary, there are no dependencies to download. 
Simply copy the contents of the repo to an empty folder and begin building your project.

### Service container
- Only required for interface-to-concrete bindings and singleton declaration
- The `Providers` folder contains a default `Providers` class. 
- You can add more files to this folder and they will be parsed during bootstrapping
- Provider classes should have `namespace Providers` and extend `Cubic\Providers\Provider`

Bind as follows:
```
//Bind an interface to concrete:
$this->bind(Interface::class, Concrete::class);

//Declare a class as a singleton
$this->singleton(Singleton::class);

//Bind an interface to concrete as a singleton
$this->singleton(Interface::class, Concrete::class);
```

To resolve a class from the service container, 
which also provides recursive dependency injection, use the `create` helper:
```
$class = create(Requirement::class);
```

### Configuration
- You can create config variables by creating files in the Config folder.
- Each file should just return an array. The array can be multidimensional.
- To access configuration, use the `config` helper function with dot notation for array access. 
- The first element should be the name of the file.

```
FILE pub.php

<? php

return [
    'staff' => [
        'manager' => 'Sammy',
        'chef' => 'Jim',
        'bar' => 'Charlie',
    ]
];

----

$chef = config('pub.staff.chef');
```

### Output Logging
- Output to the command line using `Cli::log('text', [optional ansi colour number])`
- Ansi colour numbers can be accessed via `CliColours::[colour]`
- Within a Command context, logging can be easily done with `$this->log('text')` and `$this->error('problem')`

### Commands
- Create command classes within the `Commands` folder and namespace
- The class should extend `Cubic\Cli\Command`
- The class should declare `protected` properties for the cli command name and the arguments/options signature

```
    public string $command = 'app:generate';
    public string $signature = "param ?optional --option|o --flag|f";
    
    $arg = argument('optional'); //Returns NULL if not provided
    $opt = option('option'); //Returns value if followed by =value, else true/false
```

To invoke the command, use the provided `./run` helper:
```
./run app:generate "parameter value" --option=yes -f
```

The above would provide:
```
argument('param') = "parameter value"
argument('optional') = "null"
option('option') = "yes"
option('flag') = true
```
