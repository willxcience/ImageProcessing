#include <opencv2/highgui/highgui.hpp>
#include <opencv2/imgproc/imgproc.hpp>
#include <opencv2/core/core.hpp>
#include <opencv2/imgcodecs/imgcodecs.hpp>
#include <opencv2/imgproc.hpp>
#include <opencv2/videoio.hpp>
#include <opencv2/highgui.hpp>
#include <opencv2/video.hpp>
#include <cv.hpp>
#include <opencv2/video/background_segm.hpp>

#include <iostream>
//#include <Windows.h>

using namespace cv;
using namespace std;

//Global variables
Mat curFrame;   //current frame
int keyboard = 0;   //input from keyboard

void processImages();
string generateFileName(int index);
bool checkGrayscale(Mat src);

void overlayImage(const cv::Mat &background, const cv::Mat &foreground,
                  cv::Mat &output, cv::Point2i location)
{
    background.copyTo(output);
    
    
    // start at the row indicated by location, or at row 0 if location.y is negative.
    for(int y = std::max(location.y , 0); y < background.rows; ++y)
    {
        int fY = y - location.y; // because of the translation
        
        if(fY >= foreground.rows)
            break;
        
        // start at the column indicated by location,
        
        // or at column 0 if location.x is negative.
        for(int x = std::max(location.x, 0); x < background.cols; ++x)
        {
            int fX = x - location.x; // because of the translation.
            
            // we are done with this row if the column is outside of the foreground image.
            if(fX >= foreground.cols)
                break;
            
            bool flag = 0;
            
            for(int c = 0; c < output.channels(); ++c)
            {
                unsigned char foregroundPx =
                foreground.data[fY * foreground.step + fX * foreground.channels() + c];
                
                if (foregroundPx >= 230)
                    flag = 1;
                
            }
                if (flag == 1)
                    continue;
           
            
            // but only if opacity > 0.
            for(int c = 0; c < output.channels(); ++c)
            {
                unsigned char foregroundPx =
                foreground.data[fY * foreground.step + fX * foreground.channels() + c];

                
                output.data[y*output.step + output.channels()*x + c] =  foregroundPx;
                
            }
        }
    }
}

int main()
{
    processImages();
    
    destroyAllWindows();
    return EXIT_SUCCESS;
}

void processImages()
{
    namedWindow("Background", CV_WINDOW_NORMAL);
    namedWindow("Foreground", CV_WINDOW_NORMAL);
    namedWindow("Result", CV_WINDOW_NORMAL);
    
    string fileName;
    Mat b = imread("back.JPG");
    Mat f = imread("fore.jpg");
    Mat r;
    
    imshow("Background", b);
    imshow("Foreground", f);
    
    overlayImage(b, f,
                 r, Point(500,500));
    
    imshow("Result", r);
    
    while ((char)keyboard != 'q' && (char)keyboard != 27)
        keyboard = waitKey(0);
}

string generateFileName(int index = 1)
{
    const string path = "/Users/will/Desktop/DATA/";
    const string prefix = "IMG_";
    const string suffix = ".JPG";
    string name = path + prefix;
    
    int n = 0;
    for (int i = index; i > 9; i /= 10)
        n++;
    
    for (int i = 0; i < 3 - n; i++)
        name = name + '0';
    
    name = name + to_string(index) + suffix;
    
    return name;
}

int countPixels(Mat a)
{
    return countNonZero(a);
}


bool checkGrayscale(Mat src)
{
    Mat bgr[3];
    split(src,bgr);//split source
    
    cv::Mat diff = bgr[0] != bgr[1];
    bool eq = cv::countNonZero(diff) == 0;
    cout << eq << endl;
    return eq;
}