/*
 * Miniatura.java
 *
 * Created on 30 de Março de 2007, 15:33
 *
 * To change this template, choose Tools | Template Manager
 * and open the template in the editor.
 */
package bean;
import java.awt.Graphics2D;   
import java.awt.RenderingHints;   
import java.awt.image.BufferedImage;   
import java.io.File;   
import java.io.IOException;   
import java.util.Iterator;   
import java.util.Locale;   
import javax.imageio.IIOImage;   
import javax.imageio.ImageIO;   
import javax.imageio.ImageTypeSpecifier;   
import javax.imageio.ImageWriteParam;   
import javax.imageio.ImageWriter;   
import javax.imageio.plugins.jpeg.JPEGImageWriteParam;   
import javax.imageio.stream.ImageOutputStream;  
import javax.imageio.ImageIO;
/**
 *
 * @author renan
 */
public class Miniatura {
    /** Creates a new instance of Miniatura */
    public Miniatura() {
    }
   private double widthFile = 0;   
   private double heightFile = 0;   
   private int width, height;   
   public void compressJpegFile(File infile, File outfile,float compressionQuality,int widthCanvas,int heightCanvas)   
      throws IOException {   
         // Retrieve jpg image to be compressed   
         BufferedImage rendImage = ImageIO.read(infile);            
         widthFile = rendImage.getWidth();   
         heightFile = rendImage.getHeight();   
         double aspectRatioCanvas = widthCanvas/heightCanvas;   
         double aspectRatioFile = widthFile/heightFile;   
         widthFile = widthCanvas;               
         heightFile = widthCanvas/aspectRatioFile;                     
         if(heightFile>heightCanvas){   
            heightFile = heightCanvas;   
            widthFile = heightCanvas*aspectRatioFile;      
         }   
         this.width = (int)widthFile;   
         this.height = (int)heightFile;   
         ImageTypeSpecifier its = ImageTypeSpecifier.createFromRenderedImage(rendImage);   
         BufferedImage outImage = its.createBufferedImage(width, height);   
         Graphics2D graphics2D = outImage.createGraphics();   
         graphics2D.setRenderingHint(RenderingHints.KEY_INTERPOLATION,   
         RenderingHints.VALUE_INTERPOLATION_BILINEAR);   
//         graphics2D.drawRenderedImage(rendImage, new AffineTransform());   
         graphics2D.drawImage(rendImage, 0, 0, width, height, null);   
         // Find a jpeg writer   
         ImageWriter writer = null;   
         Iterator iter = ImageIO.getImageWritersByFormatName("jpg");   
         if (iter.hasNext()) {   
            writer = (ImageWriter)iter.next();   
         }   
         // Prepare output file   
         ImageOutputStream ios = ImageIO.createImageOutputStream(outfile);   
         writer.setOutput(ios);   
         // Set the compression quality   
         ImageWriteParam iwparam = new JPEGImageWriteParam(Locale.getDefault());   
         iwparam.setCompressionMode(ImageWriteParam.MODE_EXPLICIT) ;   
         iwparam.setCompressionQuality(compressionQuality);   
         // Write the image   
         writer.write(null, new IIOImage(outImage, null, null), iwparam);   
         //infile.delete();   
         // Cleanup   
         ios.flush();   
         writer.dispose();   
         ios.close();   
        // return 
   }   
   public int getLargura(){   
      return width;         
   }   
   public int getAltura(){   
      return height;         
   }  
}