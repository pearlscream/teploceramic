module.exports = function(grunt) {

  var message = grunt.option('m') || 'commit';  // Сообщение коммита, использование:
                                                // gtunt --m="commit message goes here"

  grunt.initConfig({
    dploy: {                                            // Task
      stage: {                                          // Target
        host: "fvh80.mirohost.net",                  // Your FTP host
        user: "teploceramic",  // Your FTP user
        pass: "EDsgAqon",                               // Your FTP secret-password
        path: {
            local: "",          // The local folder that you want to upload
            remote: "/teploceramic.pro"          // Where the files from the local file will be uploaded at in your remote server
        }
      }
    },
   
    gitcommit: {
      task:{
        options: {
          message: message,
          noVerify: false,
          noStatus: false,
          verbose: false
        },
        files:{
          src: ['.']
        }
      }
    },
    gitpull: {
      task: {
        options: {
          verbose: true
        }
      }
    },
    gitpush: {
      task: {
        options: {
          verbose: true
        }
      }
    },
  });

  grunt.loadNpmTasks('grunt-dploy');
  grunt.loadNpmTasks('grunt-git');
  // 4. Указываем, какие задачи выполняются, когда мы вводим «grunt» в терминале
  grunt.registerTask('default', ['gitcommit', 'gitpull', 'gitpush', 'dploy']);

};