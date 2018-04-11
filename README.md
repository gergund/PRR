
To build .phar file: 
```$vendor/bin/phar-builder package composer.json```

Download app.phar by URL:
```$wget https://github.com/gergund/PRR/raw/master/build/app.phar```

Run Performance Review Report tool:
```$php app.phar collect:data application```
or
```$chmod +x app.phar
$./app.phar collect:data application```

Report Example: 
```
Application Role:

OS Parameters Table:
+--------------+-----------------------------------------------------------+
| Platform     | Linux                                                     |
| Release      | Red Hat Enterprise Linux Server release 6.9 (Santiago)    |
| Kernel       | 2.6.32-642.15.1.el6.x86_64                                |
| Architecture | CPU = 64-bit, OS = 64-bit                                 |
| Threading    | NPTL 2.12                                                 |
| Compiler     | gcc version 4.4.7 20120313 (Red Hat 4.4.7-18) (GCC)       |
| Hostname     | 857920-mediaimport.vfeurope.com                           |
| SELinux      | Disabled                                                  |
| Virtualized  | VMware                                                    |
| Processors   | physical = 2, cores = 1, virtual = 2, hyperthreading = no |
| Model        | 2xIntel(R) Xeon(R) CPU E5-2640 0 @ 2.50GHz                |
+--------------+-----------------------------------------------------------+
```

