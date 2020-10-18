<?php

namespace Bankas;

class TopAndBottomView {
    public function showTopView() {
        return require DIR.'../App/views/top.php';
    }
    public function showBottomView() {
        return require DIR.'../App/views/bottom.php';
    } 
}