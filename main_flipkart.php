            $pid = $_POST['flipkart_pid']; //POST Product ID (PID) FROM URL
            $this->load->view('path/to/your/clusterdev.flipkart-api.php');
            $flipkart = new \clusterdev\Flipkart("affiliate-id", "affiliate-api-key", "json");
            $url = 'https://affiliate-api.flipkart.net/affiliate/product/json?id=' .$pid;

            $details = $flipkart->call_url($url);
            if(!$details)
            {
                $response = array();
                $response['product_status'] = 'invalid';
                echo json_encode($response);
            }
            else
            {
                    $details = json_decode($details, TRUE);
                    $sprice = $details['productBaseInfo']['productAttributes']['sellingPrice']['amount'];
                    $mprice = $details['productBaseInfo']['productAttributes']['maximumRetailPrice']['amount'];
                    $title = $details['productBaseInfo']['productAttributes']['title'];
                    $description = $details['productBaseInfo']['productAttributes']['productDescription'];
                    $productImage = array_key_exists('200x200', $details['productBaseInfo']['productAttributes']['imageUrls'])?$details['productBaseInfo']['productAttributes']['imageUrls']['200x200']:'';
                    
                    $response = array();
                    $response['product_status'] = 'valid';
                    $response['productTitle'] = $title;
                    $response['productDescription'] = $description;
                    $response['productsPrice'] = $sprice;
                    $response['productmPrice'] = $mprice;
                    $response['productImage'] = $productImage;
                    echo json_encode($response); //This Will Send the Encoded Data (JSON Format) You can Use it Anywhere in AJAX/PHP/HTML         
            }
