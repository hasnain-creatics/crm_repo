<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class OrderFeedbackDocuments extends Model
{
    use HasFactory;
    
    protected $table = 'order_feedback_documents';

    protected $id = 'id';

    protected $fillable = ['*'];

}
