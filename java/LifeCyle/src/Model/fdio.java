package Model;


import java.io.File;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author GestãodoConhecimento
 */
public class fdio {
    
   fdio()
   {
       System.out.println("ZzZzZz - fdio Init");
   }
    public static void main(String[] args) {
    

   }    

    void getFileList() {
      File f = null;
      String[] paths;
      String dir = "D:/tmp/ASS/";
      try{      
         // create new file
          System.out.println("Readling... " + dir);
         f = new File(dir);
                                 
         // array of files and directory
         paths = f.list();
            
         // for each name in the path array
         for(String path:paths)
         {
            // prints filename and directory name
            System.out.println(path);
         }
      }catch(Exception e){
         // if any error occurs
         e.printStackTrace();
      }
    }
}
