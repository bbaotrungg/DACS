<?php

//Get all 
function getAllComment($conn) {
    $sql = "SELECT * FROM comment";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0;
    }
}

//Get by ID
function getCommentById($conn, $id) {
    $sql = "SELECT * FROM comment WHERE comment_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if($stmt->rowCount() >= 1) {
        $data = $stmt->fetch();
        return $data;
    } else {
        return 0;
    }
}

//Count comments
function countByPostId($conn, $id) {
    $sql = "SELECT * FROM comment WHERE post_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->rowCount();  
}

//Count likes
function likeCountByPostId($conn, $id) {
    $sql = "SELECT * FROM post_like WHERE post_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->rowCount();  
}

//isLiked
function isLikedByUserId($conn, $post_id, $user_id) {
    $sql = "SELECT * FROM post_like WHERE post_id=? AND liked_by=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$post_id, $user_id]);

    if ($stmt->rowCount() > 0) {
        return 1;
    } else return 0;
}

function getCommentsByPostId($conn, $id) {
    $sql = "SELECT * FROM comment WHERE post_id=? ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0;
    } 
}

//Delete by ID
function deleteCommentById($conn, $id) {
    $sql = "DELETE FROM comment WHERE comment_id = ?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$id]);

    if($res) {
        return 1;
    } else {
        return 0;
    }
}

//Delete by post ID
function deleteCommentByPostId($conn, $id) {
    $sql = "DELETE FROM comment WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$id]);

    if($res) {
        return 1;
    } else {
        return 0;
    }
}

function deleteLikeByPostId($conn, $id) {
    $sql = "DELETE FROM post_like WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$id]);

    if($res) {
        return 1;
    } else {
        return 0;
    }
}