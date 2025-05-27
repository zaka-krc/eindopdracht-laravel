<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a new comment
     */
    public function store(Request $request, NewsItem $newsItem)
    {
        $validated = $request->validate([
            'content' => 'required|string|min:3|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ], [
            'content.required' => 'Je comment kan niet leeg zijn.',
            'content.min' => 'Je comment moet minimaal 3 karakters bevatten.',
            'content.max' => 'Je comment mag maximaal 1000 karakters bevatten.',
            'parent_id.exists' => 'De comment waarop je reageert bestaat niet meer.',
        ]);

        // Check if parent comment belongs to same news item
        if (!empty($validated['parent_id'])) {
            $parentComment = Comment::find($validated['parent_id']);
            if ($parentComment && $parentComment->news_item_id !== $newsItem->id) {
                return back()->withErrors(['parent_id' => 'Ongeldige reply.']);
            }
        }

        Comment::create([
            'user_id' => Auth::id(),
            'news_item_id' => $newsItem->id,
            'parent_id' => $validated['parent_id'] ?? null,
            'content' => $validated['content'],
        ]);

        return back()->with('comment_success', 'Je comment is geplaatst!');
    }

    /**
     * Delete a comment
     */
    public function destroy(Comment $comment)
    {
        // Check authorization: user can delete own comments, admin can delete any
        if (Auth::id() !== $comment->user_id && !Auth::user()->is_admin) {
            abort(403, 'Je kunt alleen je eigen comments verwijderen.');
        }

        $newsItemId = $comment->news_item_id;
        $comment->delete(); // Dit verwijdert ook alle replies door cascade

        return back()->with('comment_success', 'Comment verwijderd.');
    }

    /**
     * Update a comment (optional - for editing)
     */
    public function update(Request $request, Comment $comment)
    {
        // Only comment owner can edit, not even admin
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'Je kunt alleen je eigen comments bewerken.');
        }

        // Comments can only be edited within 15 minutes
        if ($comment->created_at->diffInMinutes(now()) > 15) {
            return back()->withErrors(['edit_error' => 'Comments kunnen alleen binnen 15 minuten bewerkt worden.']);
        }

        $validated = $request->validate([
            'content' => 'required|string|min:3|max:1000',
        ], [
            'content.required' => 'Je comment kan niet leeg zijn.',
            'content.min' => 'Je comment moet minimaal 3 karakters bevatten.',
            'content.max' => 'Je comment mag maximaal 1000 karakters bevatten.',
        ]);

        $comment->update($validated);

        return back()->with('comment_success', 'Comment bijgewerkt.');
    }

    /**
     * Admin: bulk delete comments for news item
     */
    public function bulkDelete(NewsItem $newsItem)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        $deletedCount = $newsItem->comments()->delete();

        return back()->with('comment_success', "{$deletedCount} comments verwijderd.");
    }
}