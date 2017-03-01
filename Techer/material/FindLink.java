import java.io.*;
import java.util.*;

public class FindLink {
    private static Scanner in;
    private static String showLink(String filename){
        String link = "";
        
        try {
            in = new Scanner(new FileInputStream(filename));
            String temp2[] = new String[5];
            while (in.hasNextLine()){
                
                String temp = in.nextLine();
                
                if (temp.indexOf(".php") != -1){
                    temp2[0] += "  " + temp + "\n";
                } else if (temp.indexOf(".css") != -1 && temp.indexOf(".css(") == -1){
                    temp2[1] += "  " + temp + "\n";
                } else if (temp.indexOf(".js") != -1){
                    temp2[2] += "  " + temp + "\n";
                } else if (temp.indexOf(".jpg") != -1
                           || temp.indexOf(".png") != -1
                           || temp.indexOf(".gif") != -1){
                    temp2[3] += "  " + temp + "\n";
                } else if (temp.indexOf("http") != -1) {
                    temp2[4] += "  " + temp + "\n";
                }
            }
            
            link = "\n.php: \n" + temp2[0] +
                    "\n.css: \n" + temp2[1] +
                    "\n.js: \n" + temp2[2] +
                    "\n.jpg,png,gif: \n" + temp2[3] +
                    "\nhttp url: \n" + temp2[4];
            
        } catch (IOException e){
            System.out.println(e.getMessage());
        } catch (Exception e){
            System.out.println(e.getMessage());
        }
        
        return link;
    }
    
    public static void main(String[] args) {
        try {
        Scanner in = new Scanner(showLink("dir.txt"));
        FileWriter out = new FileWriter("outputDir.txt");
        
        while (in.hasNext()){
            String temp = "";
            if ((temp = in.next()).indexOf(".php") != -1
                 || temp.indexOf(".css") != -1
                 || temp.indexOf(".js") != -1
                 || temp.indexOf(".jpg") != -1
                 || temp.indexOf(".png") != -1
                 || temp.indexOf("http") != -1
                 || temp.indexOf(".gif") != -1){
                out.write("\n" + temp + "\n" + showLink(temp));
            }
        }
        
        out.close();
        
        } catch (IOException e){
            System.out.println(e.getMessage());
        } catch (Exception e){
            System.out.println(e.getMessage());
        } 
    }
    
}
